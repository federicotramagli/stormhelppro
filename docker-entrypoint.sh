#!/bin/bash
set -e

# Fix MPM at runtime
echo "=== Fixing Apache MPM ==="
find /etc/apache2/mods-enabled -name 'mpm_*' -delete 2>/dev/null || true
ln -sf /etc/apache2/mods-available/mpm_prefork.load /etc/apache2/mods-enabled/mpm_prefork.load
ln -sf /etc/apache2/mods-available/mpm_prefork.conf /etc/apache2/mods-enabled/mpm_prefork.conf
echo "MPM modules enabled:"
ls /etc/apache2/mods-enabled/mpm* 2>/dev/null

# Fix PORT - Railway sets this to something other than 80
LISTEN_PORT="${PORT:-80}"
echo "=== Railway PORT: $LISTEN_PORT ==="
sed -i "s/Listen 80/Listen $LISTEN_PORT/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:$LISTEN_PORT>/" /etc/apache2/sites-available/000-default.conf
echo "ServerName localhost" >> /etc/apache2/apache2.conf
echo "ports.conf:"
cat /etc/apache2/ports.conf

echo "MySQL host: ${MYSQLHOST:-NOT_SET}"
echo "MySQL user: ${MYSQLUSER:-NOT_SET}"
echo "MySQL db:   ${MYSQLDATABASE:-NOT_SET}"

if [ -n "$MYSQLHOST" ]; then
    echo "Waiting for MySQL (max 60s)..."
    RETRIES=20
    until mysql --skip-ssl -h"$MYSQLHOST" -P"${MYSQLPORT:-3306}" -u"$MYSQLUSER" -p"$MYSQLPASSWORD" -e "SELECT 1" >/dev/null 2>&1; do
        RETRIES=$((RETRIES - 1))
        if [ "$RETRIES" -le 0 ]; then
            echo "MySQL not reachable after 60s, starting anyway..."
            break
        fi
        sleep 3
    done

    TABLE_COUNT=$(mysql --skip-ssl -h"$MYSQLHOST" -P"${MYSQLPORT:-3306}" -u"$MYSQLUSER" -p"$MYSQLPASSWORD" "$MYSQLDATABASE" -e "SHOW TABLES;" 2>/dev/null | wc -l || echo "0")
    if [ "$TABLE_COUNT" -lt 2 ]; then
        echo "Importing database..."
        mysql --skip-ssl -h"$MYSQLHOST" -P"${MYSQLPORT:-3306}" -u"$MYSQLUSER" -p"$MYSQLPASSWORD" "$MYSQLDATABASE" \
            < /tmp/wordpress-import.sql \
            && echo "Database imported." || echo "Import failed."
    else
        echo "Database already populated, skipping import."
    fi
fi

exec docker-entrypoint.sh "$@"
