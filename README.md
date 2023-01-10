# Module Media

Module Media

## Installation

You can install the package via composer:

```bash
composer require kedeka/media
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="media-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="media-config"
```

This is the contents of the published config file:

```php
return [

];
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/riskihajar/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Rizky Hajar](https://github.com/riskihajar)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
