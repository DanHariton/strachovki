#!/bin/bash

cd ${WORKSPACE}
cp /code/carShowroom/.env.local ${WORKSPACE}/.env.local
composer install
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --dump-sql --force
npm i
npm run prod
sudo ln -sfn ${WORKSPACE}/public /var/www/html
sudo service httpd restart