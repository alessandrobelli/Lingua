# :tongue: Lingua
## Translation Manager for Laravel, built with TALL stack.

_:it: From Italian: Lingua means both Tongue and Language_

[![Latest Version on Packagist](https://img.shields.io/packagist/v/alessandrobelli/lingua.svg?style=flat-square)](https://packagist.org/packages/alessandrobelli/lingua)
![GitHub Tests Action Status](https://github.com/alessandrobelli/lingua/workflows/Tests/badge.svg)[![Total Downloads](https://img.shields.io/packagist/dt/alessandrobelli/lingua.svg?style=flat-square)](https://packagist.org/packages/alessandrobelli/lingua)
[![Total Downloads](https://img.shields.io/packagist/dt/alessandrobelli/lingua.svg?style=flat-square)](https://packagist.org/packages/alessandrobelli/lingua)


Lingua is a dashboard that allows you to create, manage and import your translations for your project.

**This package is in pre-release with known issues. Please report them.**

I would like to warmly thank [Spatie](https://spatie.be/) and Freek to have though me how to develop packages.

## Requirements

1. [Install AlpineJS](https://github.com/alpinejs/alpine) and include it in your JS file.
2. [Install Livewire](https://laravel-livewire.com/docs/2.x/installation).
3. Then you can install the package via composer.

## Installation

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

Then you can go to /desiredslug to see the dashboard.

![Lingua_Dashboard](https://user-images.githubusercontent.com/3796324/96856448-3397cd80-145e-11eb-9aab-a842e1a13979.png)

To use the translation files for Javascript files place this into your header:
```Javascript
    <script>
        window.trans = [];
        window.trans = <?php
        if(File::exists(resource_path() . "/lang/" . App::getLocale() . '.json'))
        {
            $json_file = File::get(resource_path() . "/lang/" . App::getLocale() . '.json');
            echo json_decode(json_encode($json_file, true));
        }
        else{
            echo "[]";
        }
        ?>;
    </script>
```

Then make a prototype function in Javascript to detect the `trans()` function inside your Javascript files, or use this, in case you use Vuejs and Lodash:

```Javascript
Vue.prototype.trans = (key) =>
    {
    return _.isEmpty(
        window.trans[key]) || _.isUndefined(window.trans[key]) ?
        key :
        window.trans[key];
    };
```

The language shown will be according to the locale of the browser, or you can use [this tutorial which worked for me](https://www.ryanoun.com/coding-notes/laravel/set-and-store-locale-in-laravel-5-6-using-middleware/).

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
