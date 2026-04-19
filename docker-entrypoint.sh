#!/bin/bash
set -e

echo "Waiting for MySQL to be ready..."
until mysql -h"$MYSQLHOST" -P"${MYSQLPORT:-3306}" -u"$MYSQLUSER" -p"$MYSQLPASSWORD" -e "SELECT 1" >/dev/null 2>&1; do
    sleep 3
done
echo "MySQL is ready."

TABLE_COUNT=$(mysql -h"$MYSQLHOST" -P"${MYSQLPORT:-3306}" -u"$MYSQLUSER" -p"$MYSQLPASSWORD" "$MYSQLDATABASE" -e "SHOW TABLES;" 2>/dev/null | wc -l)
if [ "$TABLE_COUNT" -lt 2 ]; then
    echo "Importing database..."
    mysql -h"$MYSQLHOST" -P"${MYSQLPORT:-3306}" -u"$MYSQLUSER" -p"$MYSQLPASSWORD" "$MYSQLDATABASE" < /var/www/html/stormhelppro_com-2026-04-10-e1ea6b5.sql
    echo "Database imported successfully."
else
    echo "Database already populated, skipping import."
fi

exec "$@"
