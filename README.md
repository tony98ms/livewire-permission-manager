# livewire-permission

[![Latest Stable Version](http://poser.pugx.org/tonystore/livewire-permission/v)](https://packagist.org/packages/tonystore/livewire-permission)  [![Total Downloads](http://poser.pugx.org/tonystore/livewire-permission/downloads)](https://packagist.org/packages/tonystore/livewire-permission)  [![License](http://poser.pugx.org/tonystore/livewire-permission/license)](https://packagist.org/packages/tonystore/livewire-permission)  [![PHP Version Require](http://poser.pugx.org/tonystore/livewire-permission/require/php)](https://packagist.org/packages/tonystore/livewire-permission)

  

Package that provides a graphical interface to manage roles and permissions.
## REQUIREMENTS

-   [PHP >= 7.2](http://php.net/)
-   [Laravel 7|8](https://laravel.com/)
-   [Livewire](https://laravel-livewire.com/)
-   [Laravel  Permission](https://github.com/spatie/laravel-permission)
-   [Bootstra 4.5 | 4.6](https://getbootstrap.com/)

## INSTALLATION VIA COMPOSER

### Step 1: Composer

Run this command line in console.
``` bash
composer require tonystore/livewire-permission
```
### Step 2: Publish Assets
#### Publish Config File
``` bash
php artisan vendor:publish --provider="Tonystore\LivewirePermission\LivewirePermissionProvider" --tag=config
``` 
#### Publish Views
Publish the views only if any modifications to the interfaces are required.
``` bash
php artisan vendor:publish --provider="Tonystore\LivewirePermission\LivewirePermissionProvider" --tag=views
``` 

#### Publish Migrations
Publishes migrations, only if a new column is created for the detail of a role or permission.
``` bash
php artisan vendor:publish --provider="Tonystore\LivewirePermission\LivewirePermissionProvider" --tag=migration
``` 

#### Publish Langs
Publish the translations in case you wish to modify any of them.
``` bash
php artisan vendor:publish --provider="Tonystore\LivewirePermission\LivewirePermissionProvider" --tag=langs
``` 
## Usage
By default, Bootstrap is used to create the administration interface for roles and permissions, with support for Tailwind coming soon.

```php
<?php
return [
	/*
	 * Supported Theme: "bootstrap",
	 */
	'theme'  =>  "bootstrap",
];
```

### Configure blade directives
```php
<?php
return [
	'blade'  => [
		'extends'  =>  "layouts.app", //By Defaut.
		'section'  =>  "content", //By Defaut.
	],
];
```
### Route
Set your own prefix and midlewares and name for the role management path and permissions. By default you will have the following:

```php
<?php
return [
	'route'  => [
		'middleware'  => [
			'web',
			'auth'
		],
	'prefix'  =>  "admin",
	'name'  =>  "permission.index",
	],
];
```

### Select a Modal design
You will be able to select among the types of manners that the package will have, at the moment only a list type model is available, which is configured here:

```php
<?php
return [
	'modals'  => [
		'role'  =>  "list"
	],
];
```

###  Change tables name
Here you assign the names of the tables to be able to run the migration. By default it uses the tables listed in the Laravel Permission package.
```php
<?php
return [
	'tables'  => [
		'roles'  =>  config('permission.table_names.roles', 'roles'),
		'permissions'  =>  config('permission.table_names.permissions', 'permissions'),
	],
];
```

### Exclude roles
Here you define the roles you want to exclude from Livewire queries for display and modification. By default you will have an empty array.
```php
<?php
return [
	'roles'  => [
		'excludes'  => []
	]
];
```
### Column name
Here you define the name of the new column that will be created in the roles and permissions table defined, with this you can add a description to each role or permission created, by default the name of the column is description. By default the name.
```php
<?php
return [
	'column_name'  => [
		'description'  =>  null,
	],
];
```
