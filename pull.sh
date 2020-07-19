#!/usr/bin/env bash

git pull
composer install
npm i
php bin/console doctrine:schema:update --dump-sql --force