# livewire-permission-manager

[![Latest Stable Version](http://poser.pugx.org/tonystore/livewire-permission-manager/v)](https://packagist.org/packages/tonystore/livewire-permission-manager)  [![Total Downloads](http://poser.pugx.org/tonystore/livewire-permission-manager/downloads)](https://packagist.org/packages/tonystore/livewire-permission-manager)  [![License](http://poser.pugx.org/tonystore/livewire-permission-manager/license)](https://packagist.org/packages/tonystore/livewire-permission-manager)  [![PHP Version Require](http://poser.pugx.org/tonystore/livewire-permission-manager/require/php)](https://packagist.org/packages/tonystore/livewire-permission)

  

Package that provides a graphical interface to manage roles and permissions.
## REQUIREMENTS

-   [PHP >= ^8.0](http://php.net)
-   [Laravel 7|8|9|10](https://laravel.com)
-   [Livewire 2|3](https://livewire.laravel.com/)
-   [Laravel  Permission](https://github.com/spatie/laravel-permission)
- [Bootstrap 4.5 | 4.6 | ^5.0](https://getbootstrap.com) or [Tailwind](https://tailwindcss.com) 

## Version Compatibility Livewire

 Livewire  | Livewire Permission Manager
:---------|:----------
 2.x      | 0.2.x
 3.x      | 0.3.x

## INSTALLATION VIA COMPOSER

### Step 1: Composer

Run this command line in console.
``` bash
composer require tonystore/livewire-permission-manager
```
### Step 2: Publish Assets
#### Publish Config File
``` bash
php artisan vendor:publish --provider="Tonystore\LivewirePermission\LivewirePermissionProvider" --tag=config-permission
``` 
#### Publish Views
Publish the views only if any modifications to the interfaces are required.
``` bash
php artisan vendor:publish --provider="Tonystore\LivewirePermission\LivewirePermissionProvider" --tag=views-permission
``` 

#### Publish Migrations
Publishes migrations, only if a new column is created for the detail of a role or permission.
``` bash
php artisan vendor:publish --provider="Tonystore\LivewirePermission\LivewirePermissionProvider" --tag=migrations-permission
``` 

#### Publish Lang
Publish the translations in case you wish to modify any of them.
``` bash
php artisan vendor:publish --provider="Tonystore\LivewirePermission\LivewirePermissionProvider" --tag=langs-permission
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
**Includes the component that contains the scripts and styles needed for the graphic interface.**
```html
<head>
    ....
       <x-permissions::styles />
    ....
</head>
 <body> 
    ...
    @livewireScripts
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    //INSERT COMPONENT
       <x-permissions::scripts />
  
 </body>

```
**To remove a role, SweetAlert is used, so you must have it in your design, and it must be before the script component.**
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

### Customized page
Here you define the array of numbers for the paging options.

```php
<?php
   'paginate' => [
        'perPages' => [
            10, 25, 50, 100, 200
        ]
    ]
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
		'add_column' => false,
		'description'  =>  null,
	],
];
```
**If you mark as true the option to add the description column, you must have previously generated that column in the respective database table.**

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
