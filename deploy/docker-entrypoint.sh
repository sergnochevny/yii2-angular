#!/bin/sh 
set -ex
cd /app/
npm i
npm run build
composer -g config http-basic.tp.sn.com tp tp \
    && composer -g config repositories.sn composer https://tp.sn.com/repo/private/ \
    && composer -g config repositories.ait_packagist composer https://tp.sn.com/repo/packagist/ \
    && composer -g config repositories.packagist false \
    && composer -g config -l \
    && composer global require "fxp/composer-asset-plugin:^1.2.0" --no-interaction \
    && composer install --no-interaction

service postfix start

/bin/chown -R www-data:www-data /app
exec "$@"