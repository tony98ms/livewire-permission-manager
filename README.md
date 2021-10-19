# livewire-permission

[![Latest Stable Version](http://poser.pugx.org/tonystore/livewire-permission/v)](https://packagist.org/packages/tonystore/livewire-permission)  [![Total Downloads](http://poser.pugx.org/tonystore/livewire-permission/downloads)](https://packagist.org/packages/tonystore/livewire-permission)  [![License](http://poser.pugx.org/tonystore/livewire-permission/license)](https://packagist.org/packages/tonystore/livewire-permission)  [![PHP Version Require](http://poser.pugx.org/tonystore/livewire-permission/require/php)](https://packagist.org/packages/tonystore/livewire-permission)

  

Package that provides a graphical interface to manage roles and permissions.
## REQUIREMENTS

-   [PHP >= 7.2](http://php.net)
-   [Laravel 7|8](https://laravel.com)
-   [Livewire](https://laravel-livewire.com)
-   [Laravel  Permission](https://github.com/spatie/laravel-permission)
- [Bootstrap 4.5 | 4.6](https://getbootstrap.com) or [Tailwind](https://tailwindcss.com) 

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
php artisan vendor:publish --provider="Tonystore\LivewirePermission\LivewirePermissionProvider" --tag=migrations
``` 

#### Publish Lang
Publish the translations in case you wish to modify any of them.
``` bash
php artisan vendor:publish --provider="Tonystore\LivewirePermission\LivewirePermissionProvider" --tag=langs
``` 
## Usage
By default, Tailwind is used to create the role and permissions management interface, but you can also choose the Bootstrap theme.

```php
<?php
return [
	/*
	 * Supported Theme: 'tailwind, bootstrap',
	 */
	'theme'  =>  'tailwind',
];
```

### Configure templates
You have 2 alternatives to use with this package, using the blade directives or using the laravel components.
```php
<?php
return [
	'blade-template'  => [
		'type'  =>  'components', //Supported Type: 'components, directives'
		'component'  =>  'AppLayout', //type: components
		'directives'  => [ //type: directives
			'extends'  =>  'layouts.app',
			'section-content'  =>  'content',
		],
	],
];
```
**If you use the Bootstrap template, then you must load the component containing the scripts to handle the modals, in your main layout.**
```html
 <body> 
    ...
    @livewireScripts
    
    //INSERT COMPONENT
   
       <x-permissions::scripts />
  
 </body>

```
**Note that you must import it after the Livewire scripts.**


### Select a Modal design
You will be able to select among the types of manners that the package will have, at the moment only a list type model is available, which is configured here:

```php
<?php
return [
	'modals'  => [
		'role'  =>  'list'
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
		'add_column' => true,
		'description'  =>  null,
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
		'prefix'  =>  'admin',
		'name'  =>  'permission.index',
		'url'  =>  '/roles/manager'
	],
];
```
Now, once everything is configured, you will be able to access the path to manage your roles.
```css
http://localhost/admin/roles/manager
```
