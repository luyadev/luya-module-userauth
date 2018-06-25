<p align="center">
  <img src="https://raw.githubusercontent.com/luyadev/luya/master/docs/logo/luya-logo-0.2x.png" alt="LUYA Logo"/>
</p>

# LUYA <NAME> Extension

[![LUYA](https://img.shields.io/badge/Powered%20by-LUYA-brightgreen.svg)](https://luya.io)

Authsystem with username and password for a given cms page area. **It does not contain a registration process for new users in the frontend!**.

## Installation

Install the extension through composer:

```sh
composer require luyadev/luya-module-userauth:dev-master
```

Add to the config

```php
'modules' => [
    'userauthfrontend' => [
        'class' => 'luya\userauth\frontend\Module',
        'useAppViewPath' => true, // When enabled the views will be looked up in the @app/views folder, otherwise the views shipped with the module will be used.
    ],
    'userauthadmin' => 'luya\userauth\admin\Module',
],
```

And the user component

```php
'components' => [
    'user' => [
        'identityClass' => 'luya\userauth\models\User',
    ]
],
```

Add the configuration entry `userauth_redirect_nav_id` with the value of the page id you would like to redirect when a user is not logged in, this is also the page where you should include the frontend module as it will render the login form.

## Usage
