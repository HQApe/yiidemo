<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => '光景日记',
    'version' => '1.0.0',
    'homeUrl' => '/user',
    'language' => 'zh-CN',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'params' => [
        'thumbnail.size' => [128, 128],
    ],
    'timeZone' => 'America/Los_Angeles',
    'layout' => '@app/views/layouts/main.php',
    'layoutPath' => '@app/views/layouts',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'e7lOsL-EfEmf5-FCyr28GNLGeQzBRE1Z',
        ],
        'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                if ($response->data !== null) {
                    $response->statusCode = 200;
                }
            },
        ],
        'session' => [
            'class' => 'yii\web\DbSession',
             'db' => $db,  // 数据库连接的应用组件ID，默认为'db'.
             'sessionTable' => 'my_session', // session 数据表名，默认为'session'.
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
//            'identityClass' => 'app\models\User',
            'identityClass' => 'app\models\MUser',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
            'maxSourceLines' => 20,
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
                    'categories' => [
                        'yii\db\*',
                        'yii\web\HttpException:*',
                    ],
                    'except' => [
                        'yii\web\HttpException:404',
                    ],
                ],
                [
                    'class' => 'yii\log\EmailTarget',
                    'levels' => ['error'],
                    'categories' => ['yii\db\*'],
                    'message' => [
                        'from' => ['zhanghuaiqng8080@163.com'],
                        'to' => ['1411935388@qq.com'],
                        'subject' => 'Database errors at example.com',
                    ],
                ],
            ],
        ],
        'db' => $db,
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'host.docker.internal',
            'port' => 6378,
            'database' => 0,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                'list/all' => "list/all",
                '<controller:(demo|list)>s' => '<controller>/index',
                '<controller:(list)>/<code:\w+>' => '<controller>/view',
                '<controller:(demo)>/<id:\w+>' => '<controller>/view',
                '<controller:(list)>/<code:\w+>/<action:(update|delete)>' => '<controller>/<action>',
                '<controller:(demo)>/<action:(update|delete)>/<id:\w+>' => '<controller>/<action>',
                'user' => "user/list",
                'user/<id:\d+>/<userId:\d+>' => 'user/view',
                'user/<userId:\d+>' => 'user/view',
                'user/update/<userId:\d+>' => 'user/update'
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
