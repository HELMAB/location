The Cambodia Region
-------------------
Seed province, district, commune and village.

# Installation
Require the `asorasoft/location` package in your composer.json and update your dependencies:
```
composer require asorasoft/location
```

The service provider will automatically get registered. Or you may manually add the service provider in your `config/app.php` file:
```php
<?php
return [
    'providers' => [
        // ...
        Asorasoft\Location\LocationServiceProvider::class,
    ]
];
```

You should publish the migration and models files with:
```
php artisan vendor:publish --provider="Asorasoft\Location\LocationServiceProvider"
```

Then run migrate provices, districts, communes and villages table:
```
php artisan migrate
```

Finally, the command `php artisan asorasoft:location` is available, and you can start to start seeding data.
