![socialcard](art/socialcard.png)

KHRegion for Laravel (Khmer Region for Laravel)
-------------------

Seed province, district, commune and village data.

## Installation

Require the `asorasoft/location` package in your composer.json and update your dependencies.

```shell
composer require asorasoft/location
```

Register service provider in `config/app.php` file.

```php
<?php
return [
    'providers' => [
        // ...
        Asorasoft\Location\LocationServiceProvider::class,
    ]
];
```

Publishing the migration and models files.

```shell
php artisan vendor:publish --provider="Asorasoft\Location\LocationServiceProvider"
php artisan migrate
```

Go to `app/Console/Commands/RegionCommand.php` file and update `$api` attribute to secret api to get the Khmer region.

### Usage

```shell
php artisan asorasoft:region // Seeds region data
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email mabhelitc@gmail.com instead of using the issue tracker.

## Credits

-   [Mab Hel](https://github.com/HELMAB)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
