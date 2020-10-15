# Translation Manager for Laravel, built with TALL stack.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/alessandrobelli/lingua.svg?style=flat-square)](https://packagist.org/packages/alessandrobelli/lingua)
![GitHub Tests Action Status](https://github.com/alessandrobelli/lingua/workflows/Tests/badge.svg)[![Total Downloads](https://img.shields.io/packagist/dt/alessandrobelli/lingua.svg?style=flat-square)](https://packagist.org/packages/alessandrobelli/lingua)
[![Total Downloads](https://img.shields.io/packagist/dt/alessandrobelli/lingua.svg?style=flat-square)](https://packagist.org/packages/alessandrobelli/lingua)


Lingua is a dashbord that allows you to create, manage and import your translations for your project.

**This readme is under construction!**

## Installation
### Requirements

#### AlpineJS:

```
npm i alpinejs
```
Include it in your main javascript file:
```
import 'alpinejs'
```

#### Livewire

``` 
composer require livewire/livewire
``` 


1. Install AlpineJS and include it in your JS file.
2. Install Livewire.
3. Then you can install the package via composer:


```bash
composer require alessandrobelli/lingua
```

This package needs a column called *linguaprojects* on the user table, as well as a table "translations".

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="alessandrobelli\Lingua\LinguaServiceProvider" --tag="migrations"
php artisan migrate
```

## Usage
You need to add the routes to your web.php file.
```php
Route::lingua('desiredslug');
```

## More 

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email info@alessandrobelli.it instead of using the issue tracker.

## Credits

- [Alessandro Belli](https://github.com/AlessandroBelli)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
