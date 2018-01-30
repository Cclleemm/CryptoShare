#!/bin/bash
echo "********* mise en production ********" 
cd /var/www/
unset GIT_DIR
git config --system http.sslverify false
git pull origin master
php artisan migrate --force

