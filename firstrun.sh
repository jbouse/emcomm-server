#!/bin/bash

COMPOSER=$(command -v composer)
if [ -z "$COMPOSER" ]; then
    echo "Composer not found"
    exit 1
fi

YARN=$(command -v yarn)
if [ -z "$YARN" ]; then
    echo "Yarn not found"
fi

NPM=$(command -v npm)
if [ -z "$NPM" ]; then
    echo "NPM not found"
fi

if [ -z "$YARN" -a -z "$NPM" ]; then
    echo "Need Yarn or NPM installed to proceed"
    exit 1
fi

NODE_CMD=${YARN:-$NPM}

echo $NODE_CMD

$COMPOSER install
$NODE_CMD install --force
$NODE_CMD build


if [ ! -f "var/data.db" ]; then
    php bin/console regenerate-app-secret .env.local
    php bin/console doctrine:database:create --no-interaction
    php bin/console doctrine:migrations:migrate --no-interaction
    php bin/console doctrine:fixtures:load --no-interaction
    php bin/console emcomm:user:create admin admin
fi

$COMPOSER dump-env prod
$COMPOSER install --no-dev --optimize-autoloader
php bin/console cache:clear --env=prod --no-debug
php bin/console doctrine:migrations:migrate --no-interaction
