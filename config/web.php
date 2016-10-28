<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name' => 'ExtremeNavigator',
    'defaultRoute' => 'main/default/index',
    'language' => 'ru-RU',
    'sourceLanguage' => 'ru-RU',
    'version' => '1.2.0',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'IL5u04RNcOANdgRWbvovRygjiaJPQ-Vh',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
               
        'user' => [
            'identityClass' => 'app\modules\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['user/default/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'main/default/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'main/default/index',
                'contact' => 'main/contact/index',
                'about' => 'main/default/about',
                '<_a:error>' => 'main/default/<_a>',
                '<_a:(login|logout|signup)>' => 'user/default/<_a>',

                '<_m:[\w\-]+>' => '<_m>/default/index',
                '<_m:[\w\-]+>/<id:\d+>' => '<_m>/default/view/',
                '<_m:[\w\-]+>/<_a:[\w\-]+>/<id:\d+>' => '<_m>/default/<_a>',
                '<_m:[\w\-]+>/<_a:[\w\-]+>' => '<_m>/default/<_a>',
            ],
        ],
    ],
    'modules' => [
        'main' => [
            'class' => 'app\modules\main\Module',
        ],
        'user' => [
            'class' => 'app\modules\user\Module',
        ],
        'category' => [
            'class' => 'app\modules\category\Module',
        ],
        'place' => [
            'class' => 'app\modules\place\Module',
        ],
        'comment' => [
            'class' => 'app\modules\comment\Module',
        ],
        'city' => [
                'class' => 'app\modules\city\Module',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
