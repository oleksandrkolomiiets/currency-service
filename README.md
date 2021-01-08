#PHP/Laravel/Vue - Full Stack Web Developer Test
***Implement a service providing currency rates***

##Installation guide:
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan db:seed [optional]
npm install
npm run prod [dev/watch]
```

##Commands:
```bash
php artisan create:user # Create a User
php artisan create:user-token # Create User API Token
php artisan currencies:fetch # Get currencies from Bank-API and save
```

##API endpoints:
#####[POST] /api/login
    username
    password
    
#####[GET, Bearer Token required] /api/currencies
    date_from
    date_to
    page
    per_page

#####[GET, Bearer Token required] /api/currencies/{currencyCode}
    date_from
    date_to
    page
    per_page
