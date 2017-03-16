# Database Switch for Laravel and Lumen
Composer package for Laravel that enables easy replacement of database instance.
The package is highly suitable for similar databases that run different copies of a same program.

This package is being developed and tested under **Laravel 5.3**, **Laravel 5.4** and **Lumen 5.4**. However it should be compatible with the older releases
of Laravel, expecting at least as versions 5.0.

## Prerequisites

### Composer
You will need composer to setup your project. You can skip this point most-likely, since it is a must for your Laravel
or Lumen project, but if for some reason you are new to it you will find the official
[composer website](http://getcomposer.org/) very useful. You will find detailed documentation, use-cases and scenarios
plus full instruction set about the downloading and installing composer, including all the download files needed.

### Laravel/Lumen Project
We assume you have prepared and installed already your Laravel or Lumen project and you have navigated to its folder
with your console/terminal application.

## Installation
The package is installed in the traditional way through composer. You can do this by executing the following command
in the folder of your Laravel project:

```sh
composer require 'rolice/laravel-db-switch' # with globally installed composer
```

or if you have no global composer installation exists with your project, but simply `composer.phar` file:

```sh
php /path/to/composer.phar require 'rolice/laravel-db-switch' # with local composer.phar file
```

The above should add the package with your project directly.

Alternatively, you can manually add `rolice/laravel-db-switch` in your `composer.json` file in the `require` section and then  you will be able to install it with:

```sh
composer install
```

or again if no global composer installation exists:

```sh
php /path/to/composer.phar install
```

**Note**: That you will have to replace */path/to/composer.phar* in the examples above with the actual path where you
have downloaded a copy of the official *composer.phar*. More information could be found on the previous  section with
the [Prerequisites](##Prerequisites).

After you are ready with the package installation we have to enable the service provider inside the application config.

**For Laravel**: Just open the `{your/project/folder}/config/app.php` file of your application (by default should be located there).

Add the service provider inside the `providers` section (array):

```php
Rolice\LaravelDbSwitch\DbSwitchServiceProvider::class,
```

Preferably under the comment like:

```php
/*
 * Package Service Providers...
 */
 Rolice\LaravelDbSwitch\DbSwitchServiceProvider::class,
```

**For Lumen**: You should register the service provider inside `bootstrap/app.php` like:

```php
/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's servipoce providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/
// ...
$app->register(Rolice\LaravelDbSwitch\DbSwitchServiceProvider::class);
// ...
```

Now you can register the facade in the section below named `aliases` (array), in the same file `config/app.php` by
adding the following like there:

```php
'DbSwitch' => Rolice\LaravelDbSwitch\Facades\DbSwitch::class,
```

For Lumen you can enable facades and pass it along with that:

```php
$app->withFacades(true, [
    Rolice\LaravelDbSwitch\Facades\DbSwitch::class => 'DBSwitch'
]);
```

or you can directly enable it the same way, but with raw code, an example:

```php
/*
|--------------------------------------------------------------------------
| Register Facades
|--------------------------------------------------------------------------
|
| A config section for registering facades through class aliases.
|
*/

class_alias(\Rolice\LaravelDbSwitch\Facades\DbSwitch::class, 'DbSwitch');
```


Now the package should be available and running with your project.

## Usage
You can use the package service either through the facade `DbSwitch` or through the singleton instance inside the IoC
service container of Laravel:

```php
// Usage through the facade - DbSwitch
DbSwitch::to('my-cool-db'); // The defaut connection
DbSwitch::connectionTo('my-cool-conenction', 'my-cool-db'); // A specific connection database

// Usage through the Laravel Service Container (IoC)
app('db.switch')->to('my-cool-db'); // The defaut connection
app('db.switch')->connectionTo('my-cool-conenction', 'my-cool-db'); // A specific connection database
```

That is the whole scope of this package.

**Enjoy** switching your databases! :P
