# Laravel Session Manager

This module allow manage users connected in own laravel app and force logout and destroy old sessions.

## Installation

1.  With Composer : download files
```
composer require jetiradoro/laravel-session-manager
```

2. Proceed to install module
```
> php artisan session-manager:install
```
This process modify variables .env file, execute migrations and config params for fine work.


Now you can got to **http://[url_your_app]/admin/current-connections** and you looks sessions which are equal or more than 10 minutes without any request.

## Customization

If you want custom propierties in this plugins you can publish files:
```
> php artisan vendor:publish --provider="\Jetiradoro\SessionManager\SessionManagerServiceProvider"
```


### session-manager.php config file

You will can set:
* max time of inhactivity
* messages of transactions 
* Custom routes for use.

Install process modify an add variables in your *.env* file, set **SESSION_DRIVER** to 'DATABASE' and add **SM_ROUTES** variable with a true value. 

If you want change deafult routes you need set this variable to false, and modify **session-manager.php** config file to new routes.

> This plugin uses vue.js and axios, in view layout load this libraries moreover necessary app.js file. If you want change main layout is necessary that you load app.js file 