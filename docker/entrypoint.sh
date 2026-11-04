#!/bin/sh
set -e

php artisan migrate --force
php artisan db:seed --force   # cria/atualiza o admin a partir de ADMIN_*
php artisan optimize

exec "$@"
