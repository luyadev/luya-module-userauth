<p align="center">
  <img src="https://raw.githubusercontent.com/luyadev/luya/master/docs/logo/luya-logo-0.2x.png" alt="LUYA Logo"/>
</p>

# LUYA <NAME> Extension

[![LUYA](https://img.shields.io/badge/Powered%20by-LUYA-brightgreen.svg)](https://luya.io)

Authsystem with username and password for a given cms page area. **It does not contain a registration process for new users in the frontend!**.

## Installation

1. Install the extension through composer:
```sh
composer require luyadev/luya-module-userauth:dev-master
```
2. Add to the config
```php
'modules' => [
    'userauthfrontend' => [
        'class' => 'luya\userauth\frontend\Module',
        'useAppViewPath' => false, // When enabled the views will be looked up in the @app/views folder, otherwise the views shipped with the module will be used.
    ],
    'userauthadmin' => 'luya\userauth\admin\Module',
],
```
3. And the user component
```php
'components' => [
    'user' => [
        'identityClass' => 'luya\userauth\models\User',
    ]
],
```
4. Place the `userauthfrontend` module on a given page in the cms.
5. Add the config variable identifier `userauth_redirect_nav_id` with the value of the page you have included the `userauthfrontend` in step 4.
