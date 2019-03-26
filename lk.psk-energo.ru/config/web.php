<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru',
    'name'=>'ПСК ПЕРСПЕКТИВА',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'HHi5pTCPAztQQ4pSwNiqBVEjFdqPAFN7',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\modules\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['/user/security/login'],

        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => 'site/index',
                '<c:\w+>/<a:\w+>',
                '<c:\w+>/<id:\d+>' => '<c>/view',
                '<c:\w+>/<a:\w+>/<id:\d+>' => '<c>/<a>',
            ]
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'php:d.m.Y',
            'datetimeFormat' => 'php:d.m.Y H:i:s',
            'timeFormat' => 'php:H:i:s',
        ],
        'authManager' => [
            'class' => 'app\modules\user\components\DbManager',
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'modules' => [
        'user' => [
            'class' => 'app\modules\user\User',
        ],
        'rbac' => [
            'class' => 'dektrium\rbac\Module',
            'admins' => ['admin'],
        ],
        'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
            'uploadDir' => '@webroot/uploads',
            'uploadUrl' => '@web/uploads',
            'imageAllowExtensions' => ['jpg', 'png', 'gif']
        ],
        'import' => [
            'class' => 'andrew\import\Module',
            'supplier' => [
                'modelPath' => 'app\models\Supplier',
                'id' => 'id',
                'name' => 'title',
            ],
            'group' => [
                'modelPath' => 'app\models\SupplierGroup',
                'id' => 'id',
                'name' => 'title',
            ],
            'price' => [
                'modelPath' => 'app\models\Product',
                'requiredFields' => [
                    'name',
                ],
                'requiredKeyFields' => [
                    'supplier_id',
                    'group_id',
                ],
                'allowedFields' => [
                    'group_id',
                    'name',
                    'size_l',
                    'size_b',
                    'size_h',
                    'mark_b',
                    'volume',
                    'weight',
                    'price_without_vat',
                    'price_with_vat',
                ],
            ],
            'limitColumnsTo' => 10,
        ],
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
      ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
