# crmproject
CRM project by Momentum Internet Sdn Bhd

# Project Information
1. Language: PHP 7.4
2. Deloyment Server: Nginx Ubuntu 18.04
3. Database Server: Maria DB (10.2.39)/ MySQL
4. Framework: Laravel 8

# How To Install?
1. Make sure laravel da install 
2. Clone project:
```
git clone https://github.com/mrhery/crm
```
3. Dalam project folder, run:
```
composer install
php artisan key:generate
php artisan migrate
```
4. Tukar .env.example kepada .env:
```
cp .env.example .env
```
Kemudia, tukar semua detail database dlm file .env

5. Untuk run project, guna command 
```
php artisan serve
```

Default port adalah 8000. So boleh pegi kt browser and open link: http://localhost:8000/login

Sekian,
Hery
