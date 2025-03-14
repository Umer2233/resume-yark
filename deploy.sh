#!/usr/bin/env bash
cd /home/yak/www/test2.resumeyak.com/builder/
cp ./deploy/app.js ./resources/js/app.js
cp ./deploy/env.js ./resources/js/env.js
rm -rf ./vendor
composer install
npm install
npm run dev
cp ../../config/.env2 ./.env
cp ../../config/database.php ./config/
#php artisan migrate
exit
