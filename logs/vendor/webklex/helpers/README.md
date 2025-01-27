# Helpers

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Total Downloads][ico-downloads]][link-downloads]

This is a helpers package that provides some built in helpers, and also provides an Artisan generator to quickly create your own custom helpers.

## Install

Via Composer

``` bash
$ composer require webklex/helpers
```

## Setup

Add the service provider to the providers array in `config/app.php`.

``` php
'providers' => [
    webklex\helpers\HelperServiceProvider::class,
];
```

## Publishing

You can publish everything at once

``` php
php artisan vendor:publish --provider="webklex\helpers\HelperServiceProvider"
```

or you can publish groups individually.

``` php
php artisan vendor:publish --provider="webklex\helpers\HelperServiceProvider" --tag="config"
```

## Usage

This package comes with some built in helpers that you can choose to use or not. By default all of these helpers are inactive for your application. To adjust which helpers are active and which are inactive, open `config/helpers.php` and find the `package_helpers` option. Add any helpers you wish to activate to this key. Check the source code to see what functions are included in each helper and what each does.

You can also create your own custom helpers for inclusion in your application. An Artisan generator helps you quickly make new helpers for your application. 

``` sh
php artisan make:helper MyHelper
```

Your custom helper will be placed in `app/Helpers`, unless you override the default directory in your configuration.

By default, the service provider uses the `glob` function to automatically require any PHP files in the 'Helpers' directory. If you prefer a mapper based approach, you may edit the `custom_helpers` in the configuration file, and include the file name of any helpers in your custom directory you wish to activate. Within the new helper, define your own custom functions that will be available throughout your application.

``` php
if (!function_exists('hello')) {

    /**
     * say hello
     *
     * @param string $name
     * @return string
     */
    function hello($name)
    {
        return 'Hello ' . $name . '!';
    }
}
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email github@webklex.com instead of using the issue tracker.

## Credits

- [Webklex][link-author]
- Andrew Brown
- All Contributors

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/webklex/helpers.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/Webklex/helpers/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/webklex/helpers.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/webklex/helpers.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/webklex/helpers.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/webklex/helpers
[link-travis]: https://travis-ci.org/webklex/helpers
[link-scrutinizer]: https://scrutinizer-ci.com/g/webklex/helpers/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/webklex/helpers
[link-downloads]: https://packagist.org/packages/webklex/helpers
[link-author]: https://github.com/webklex
