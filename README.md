<p align="center">
  <img src="https://raw.githubusercontent.com/luyadev/luya/master/docs/logo/luya-logo-0.2x.png" alt="LUYA Logo"/>
</p>

# LUYA Frontend user authentification

[![LUYA](https://img.shields.io/badge/Powered%20by-LUYA-brightgreen.svg)](https://luya.io)

Authsystem with username and password for a given cms page area. **It does not contain a registration process for new users in the frontend!**.

## Installation

1. Install the extension through composer:
```sh
composer require luyadev/luya-module-userauth
```
2. Add to the config
```php
'modules' => [
    //...
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
    //...
    'user' => [
        'class' => 'yii\web\User',
        'identityClass' => 'luya\userauth\models\User',
    ]
],
```
4. Run the `./luya migrate` and `./luya import` command.
5. Place the `userauthfrontend` module on a given page in the cms.
6. Add the config variable identifier `userauth_redirect_nav_id` with the value of the page you have included the `userauthfrontend` in step **5**.
7. Optional you can configure with the variable identifer `userauth_afterlogin_nav_id` on which nav id the user should be redirect when no ref url is provided.

## Usage

After the installation, you can secure any given page with the user login by checking the **Protect Page** checkbox in the page's **Page properties** panel. Important: this setting will not be inherited by subpages, it has to be set for every page that has to be secured.
