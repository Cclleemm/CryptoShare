#!/bin/bash
echo "********* mise en production ********" 
cd /var/www/
unset GIT_DIR
git pull origin master
php artisan migrate