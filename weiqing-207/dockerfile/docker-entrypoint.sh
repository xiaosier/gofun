#!/bin/sh
# if the file not exist, execute copy
if [ ! -f "/var/www/html/do_not_delete" ]; then
    cp -rT /var/www/html_start /var/www/html
fi

exec "$@"