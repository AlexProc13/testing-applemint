# TESTING


Task - https://www.evernote.com/client/snv?noteGuid=27530b89-8d92-4827-bcf1-9b076406bb47&noteKey=97ec0a93d0cd4af4&sn=https%3A%2F%2Fwww.evernote.com%2Fshard%2Fs299%2Fsh%2F27530b89-8d92-4827-bcf1-9b076406bb47%2F97ec0a93d0cd4af4&title=Backend%2BPHP%2B%2528Laravel%2529


#0) Requiraments
-php7.2
-composer
-git
I use lumen.
 This how laravel only faster. By code don't have difference with laravel.


#1) Start
-create directory
-open terminal in this directory
-make 'git init'
-make  'git remote add origin git@github.com:AlexProc13/testing-applemint.git'
-make 'git pull origin master'
-make 'composer install'
- create file .env how .env.example and set APP_KEY and JWT_SECRET. 
Example APP_KEY=nlKIKzzGC06xtgu6pHvuEb4pKf1gha4m and JWT_SECRET=nlKIKzzGC06xtgu6pHvuEb4pKf1gha4m
This for example.We must to generate own crypto key. 'str_random(32)'
- make 'php artisan migrate'
- make 'php artisan db:seed'
- make php -S localhost:8000 -t public
Server start - http://localhost:8000


#2) Send queries
Open file /~thisProject~/routes/web.php and we show all routes


#3) CallBack
I will wait response form You.