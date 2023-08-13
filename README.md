<p align="center">
<img src="https://user-images.githubusercontent.com/8291514/213727234-cda046d6-28c6-491a-b284-b86c5cede25d.png#gh-light-mode-only">
<img src="https://user-images.githubusercontent.com/8291514/213727225-56186826-bee8-43b5-9b15-86e839d89393.png#gh-dark-mode-only">
</p>

[![License](http://poser.pugx.org/bilalbaraz/supabase-laravel/license)](https://packagist.org/packages/bilalbaraz/supabase-laravel)

---
# Supabase Laravel

Laravel SDK for [Supabase](https://supabase.com).

## Installation

You can install the package via composer:

```bash
composer require bilalbaraz/supabase-laravel
```

## Configure

You can publish configuration file with:

```bash
php artisan vendor:publish --tag=supabase-config
```

It creates the config file (config/supabase.php). You need to put credentials by using the followings.

```dotenv
SUPABASE_URL=<you can find the correct url on dashbard>
SUPABASE_ANON_KEY=<you can find the correct anon key on dashboard>
```

## Usage

```php
use Bilalbaraz\SupabaseLaravel\Database;

$database->select('yourTableName', '*');
$database->insert(
    'yourTableName',
    [
        ['column1' => 'value1', 'column2' => 'value2']
    ]
);
$database->delete(
    'yourTableName',
    [
        ['column1' => ['eq' => 'someValue']]
    ]
);
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Bilal Baraz](https://github.com/bilalbaraz)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
