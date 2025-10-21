![Lingua Banner](https://user-images.githubusercontent.com/3796324/193797408-61be81b3-afee-4b80-9e07-3a82472e73eb.png)


# :tongue: Lingua
## Translation Manager for Laravel, built with TALL stack.

_:it: From Italian: Lingua means both Tongue and Language_

[![Latest Version on Packagist](https://img.shields.io/packagist/v/alessandrobelli/lingua.svg?style=flat-square)](https://packagist.org/packages/alessandrobelli/lingua)
![GitHub Tests Action Status](https://github.com/alessandrobelli/lingua/workflows/Tests/badge.svg)[![Total Downloads](https://img.shields.io/packagist/dt/alessandrobelli/lingua.svg?style=flat-square)](https://packagist.org/packages/alessandrobelli/lingua)


Lingua is a dashboard that allows you to create, manage and import your translations for your project.

**Version 2.0 - Major Update**
Now supports Laravel 11 and Livewire 3. For Laravel 9/10 support, please use version 1.x.

## Version Compatibility

| Lingua Version | Laravel | Livewire | PHP   |
|----------------|---------|----------|-------|
| 2.x            | 11.x    | 3.x      | 8.3+  |
| 1.x            | 9.x-10.x| 2.x      | 8.1+  |

I would like to warmly thank [Spatie](https://spatie.be/) and Freek to have taught me how to develop packages.

## Requirements

- **PHP** 8.3 or higher
- **Laravel** 11.0 or higher
- **Livewire** 3.0 or higher
- **AlpineJS** (included with Livewire 3)

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

## Upgrading from 1.x to 2.x

Lingua 2.x requires Laravel 11 and Livewire 3. Before upgrading:

1. **Upgrade to Laravel 11** - Follow [Laravel's upgrade guide](https://laravel.com/docs/11.x/upgrade)
2. **Upgrade to Livewire 3** - Follow [Livewire's upgrade guide](https://livewire.laravel.com/docs/upgrading)
3. **Update Lingua** - Run `composer update alessandrobelli/lingua`
4. **Clear caches** - Run `php artisan optimize:clear`

### Breaking Changes
- Minimum PHP version raised from 8.1 to 8.3
- Laravel 11+ required
- Livewire 3+ required
- Event system migrated from `$emit()` to `dispatch()`

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
Vue.prototype.trans = (key) => {
    if (_.isUndefined(window.trans[key])) {
        return key;
    } else {
        if (window.trans[key] === "") return key;
        return window.trans[key];
    }
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
