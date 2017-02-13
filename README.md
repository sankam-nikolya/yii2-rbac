RBAC Manager for Yii2
======================
GUI manager for RABC (Role Base Access Control) Yii2. Easy to manage authorization of user :smile:.

Original [mdmsoft/yii2-admin](https://github.com/mdmsoft/yii2-admin)

Optimized for [trntv/yii2-starter-kit](https://github.com/trntv/yii2-starter-kit)

Installation
------------

### Install With Composer

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer require sankam/yii2-rbac "*"
```

Or, you may add

```
"sankam/yii2-rbac": "*"
```

to the require section of your `composer.json` file and execute `php composer update`.

### Install

In your application config, add the path alias for this extension.

```php
return [
    ...
	'modules'=>[
        ...
        'rbac' => [
            'class' => 'sankam\rbac\Module',
        ]
    ],
    'as access' => [
        'class' => 'sankam\rbac\components\AccessControl',
        'allowActions' => [
            'site/error',
            'sign-in/*',
        ]
    ],
    ...
];
```
