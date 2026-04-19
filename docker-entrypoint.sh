#!/bin/bash
set -e

# Set Apache port from Railway's PORT env var
echo "export APACHE_PORT=${PORT:-80}" >> /etc/apache2/envvars

echo "MySQL host: ${MYSQLHOST:-NOT_SET}"
echo "MySQL user: ${MYSQLUSER:-NOT_SET}"
echo "MySQL db:   ${MYSQLDATABASE:-NOT_SET}"

if [ -n "$MYSQLHOST" ]; then
    echo "Waiting for MySQL (max 60s)..."
    RETRIES=20
    until mysql -h"$MYSQLHOST" -P"${MYSQLPORT:-3306}" -u"$MYSQLUSER" -p"$MYSQLPASSWORD" -e "SELECT 1" >/dev/null 2>&1; do
        RETRIES=$((RETRIES - 1))
        if [ "$RETRIES" -le 0 ]; then
            echo "MySQL not reachable after 60s, starting Apache anyway..."
            break
        fi
        sleep 3
    done

    TABLE_COUNT=$(mysql -h"$MYSQLHOST" -P"${MYSQLPORT:-3306}" -u"$MYSQLUSER" -p"$MYSQLPASSWORD" "$MYSQLDATABASE" -e "SHOW TABLES;" 2>/dev/null | wc -l || echo "0")
    if [ "$TABLE_COUNT" -lt 2 ]; then
        echo "Importing database..."
        mysql -h"$MYSQLHOST" -P"${MYSQLPORT:-3306}" -u"$MYSQLUSER" -p"$MYSQLPASSWORD" "$MYSQLDATABASE" < /var/www/html/stormhelppro_com-2026-04-10-e1ea6b5.sql && echo "Database imported." || echo "Import failed."
    else
        echo "Database already populated, skipping import."
    fi
else
    echo "WARNING: MySQL variables not set, skipping DB wait."
fi

exec "$@"
