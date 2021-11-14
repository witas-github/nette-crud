#!/usr/bin/env bash

echo "######### Installing composer packages! #########"
php composer.phar install

echo "######### Creating nette log, temp folders! #########"
mkdir log
mkdir temp
chmod 777 log temp -R

echo "######### Creating config/local.neon #########"
touch config/local.neon

set -e

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- php "$@"
fi

exec "$@"