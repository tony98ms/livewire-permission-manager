<?php

return [
    /*
     |-------------------------------------------------------------------------
     |Theme Front End
     |-------------------------------------------------------------------------
     |
     |Here you define which type of thema to use to implement the styles,
     |you must define a mandatory one, however you can customize those styles
     |by publishing the respective views.
     |Supported Theme: "bootstrap",
     */
    'theme' => "bootstrap",

    /*
    |--------------------------------------------------------------------------
    | Blade Options
    |--------------------------------------------------------------------------
    |
    |Here you define the prefix that your extends and section helper blade
    |will have in order to use this package.
    |
    */

    'blade' => [
        'extends' => "layouts.app",
        'section' => "content",
    ],

    /*
    |--------------------------------------------------------------------------
    | Route Options
    |--------------------------------------------------------------------------
    |
    |Here you define your middlewares and prefix in order to customize the access
    |to the paths that will show you the graphical interface.
    |
    */

    'route' => [

        'middleware' => [
            'web',
            'auth'
        ],
        'prefix' => "admin",
        'name' => "permission.index",

    ],

    /*
    |--------------------------------------------------------------------------
    |Modals Theme
    |--------------------------------------------------------------------------
    |
    |Here you define the style or theme of the modal to be used to manage
    |roles and permissions.
    |
    | Supported Theme: "list",
    |
    */

    'modals' => [

        'role' => "list"
    ],

    /*
    |--------------------------------------------------------------------------
    |Tables Name
    |--------------------------------------------------------------------------
    |
    |Here you define the names of the tables you use to store your roles and permissions
    |in your database. It will take the names you have stored in your permissions
    |configuration file.
    |
    */

    'tables' => [
        'roles' => config('permission.table_names.roles', 'roles'),
        'permissions' => config('permission.table_names.permissions', 'permissions'),
    ],
    /*
    |--------------------------------------------------------------------------
    |Column Name
    |--------------------------------------------------------------------------
    |
    |Here you define the name of the new column that will be created in the roles
    |and permissions table defined, with this you can add a description to each
    |role or permission created, by default the name.
    |
    */
    'column_name' => [

        'description' => null,
    ],

    /*
    |--------------------------------------------------------------------------
    |Excludes Roles
    |--------------------------------------------------------------------------
    |
    |Here you define the roles you want to exclude from Livewire queries
    |for display and modification.
    |
    */
    'roles' => [
        'excludes' => []
    ]

];
