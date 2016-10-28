Yii 2 Basic Project Template
============================

Yii 2 Basic Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
rapidly creating small projects.

The template contains the basic features including user login/logout and a contact page.
It includes all commonly used configurations that would allow you to focus on adding new
features to your application.

[![Latest Stable Version](https://poser.pugx.org/yiisoft/yii2-app-basic/v/stable.png)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Total Downloads](https://poser.pugx.org/yiisoft/yii2-app-basic/downloads.png)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Build Status](https://travis-ci.org/yiisoft/yii2-app-basic.svg?branch=master)](https://travis-ci.org/yiisoft/yii2-app-basic)

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


Установка
------------


### Установка с помощью Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

После получения файлов из репозитория необходимо выполнить команды:
Выполняются из корневой папки проекта
Для UNIX-систем
~~~
php composer.phar global require "fxp/composer-asset-plugin:~1.1.1"
php composer.phar install
~~~

Для Windows
~~~
composer global require "fxp/composer-asset-plugin:~1.1.1"
composer install
~~~

Теперь вы можете получить доступ к приложению по следующему адресу.

~~~
http://localhost/basic/web/
~~~


Настройки
-------------

### База данных

Исправьте файл `config/db.php` для работы с базой, например:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```
Для развертывания базы данных необходимо выпонить команду:

~~~
yii migrate
~~~

Это создаст в базе необходимые таблицы.

**Примечания:**
- Yii не создает саму базу, это нужно сделать в ручную, прежде чем вы сможете получить доступ к ней.
- Check and edit the other files in the `config/` directory to customize your application as required.
- Refer to the README in the `tests` directory for information specific to basic application tests.
