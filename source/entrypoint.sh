#!/usr/bin/env bash

php composer.phar install
mkdir log
mkdir temp
chmod 777 log temp -R

set -e

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- php "$@"
fi

exec "$@"