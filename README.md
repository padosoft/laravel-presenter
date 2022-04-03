# Laravel Presenter

Presenter is a design pattern for Laravel which is used to modify the data that comes from your model to your views.
<br>
It causes the data to be displayed in a way understandable to humans.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/padosoft/laravel-presenter.svg?style=flat-square)](https://packagist.org/packages/padosoft/laravel-presenter)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Quality Score](https://img.shields.io/scrutinizer/g/padosoft/laravel-presenter.svg?style=flat-square)](https://scrutinizer-ci.com/g/padosoft/laravel-presenter)
[![Total Downloads](https://img.shields.io/packagist/dt/padosoft/laravel-presenter.svg?style=flat-square)](https://packagist.org/packages/padosoft/laravel-presenter)

Table of Contents
=================

   * [Laravel Package that implement presenter pattern.](#laravel-package-that-implement-presenter-pattern)
      * [Requires](#requires)
      * [Installation](#installation)
      * [USAGE](#usage)
      * [Change log](#change-log)
      * [Testing](#testing)
      * [Contributing](#contributing)
      * [Security](#security)
      * [Credits](#credits)
      * [About Padosoft](#about-padosoft)
      * [License](#license)

##Requires
  
- "php" : ">=5.6.0",
- "illuminate/support": "~5.0|^6.0|^7.0|^8.0|^9.0",
- "illuminate/database": "~5.0|^6.0|^7.0|^8.0|^9.0"

## Installation

#### Laravel 5.x

Execute the following command to get the latest version of the package:

```terminal
composer require padosoft/laravel-presenter
```

## USAGE

The first step is to store your presenters somewhere - anywhere. These will be simple objects that do nothing more than format data, as required.
<br>
Note that your presenter class must extend ```Laracodes\Presenter\Presenter```:

```php
namespace App\Presenters;

use Laracodes\Presenter\Presenter;

class UserPresenter extends Presenter
{
    public function fullName()
    {
        return $this->model->first_name . ' ' . $this->model->last_name;
    }
    
    public function accountAge()
    {
        return $this->model->created_at->diffForHumans();
    }

    ...
}
```

Next, on your model, pull in the ```Laracodes\Presenter\Traits\Presentable``` trait, which will automatically instantiate your presenter class:

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laracodes\Presenter\Traits\Presentable;

class User extends Model
{
    use Presentable;
    
    protected $presenter = 'App\Presenters\UserPresenter';

    ...
}
```

Done, now you can call it in your views:

```php
<h1>Hello, {{ $user->present()->fullName }}</h1>
<h1>Hello, {{ $user->present()->full_name }}</h1> // automatically convert to camelCase
```

Notice how the call to the present() method (which will return your new or cached presenter object) also provides the benefit of making it perfectly clear where you must go, should you need to modify how a full name is displayed on the page.

### Notices

When you call a method that does not exist in its class presenter, this package will automatically call the property in the model with conversion to snake_case.

Ex:

```php
// automatically calls the property in the model
<h1>Hello, {{ $user->present()->firstName }}</h1> // automatically convert to snake_case
<h1>Hello, {{ $user->present()->first_name }}</h1>
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email instead of using the issue tracker.

## Credits
- [Lorenzo Padovani](https://github.com/lopadova)
- [All Contributors](../../contributors)

This package is largely inspired by <a href="https://github.com/laracasts/Presenter">this</a> great package by @laracasts
and forked from <a href="https://github.com/guilhermegonzaga/presenter">guilhermegonzaga/presenter</a>.

## About Padosoft
Padosoft (https://www.padosoft.com) is a software house based in Florence, Italy. Specialized in E-commerce and web sites.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
