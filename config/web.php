<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [ 
    'id' => 'basic',
    'name' => 'Guestbook Registration',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'frontend/default' ,
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'u-0ihjbaOr1-WvAjfHXbf4NG5ttl2nOZ',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
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
        'db' => $db,
        'assetManager' => [
            // override bundles to use CDN :
            'bundles' => [
                'yii\bootstrap4\BootstrapAsset' => [
                    'sourcePath' => null,
                    'baseUrl' => 'https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1',
                    'css' => [
                        'css/bootstrap.min.css'
                    ],
                ],
                'yii\bootstrap4\BootstrapPluginAsset' => [
                    'sourcePath' => null,
                    'baseUrl' => 'https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1',
                    'js' => [
                        'js/bootstrap.min.js',
                    ],
                ],
                'yii\bootstrap4\BootstrapThemeAsset' => [
                    'sourcePath' => null,
                    'baseUrl' => null,
                    'css' => []
                ],
            ],
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            // 'enableStrictParsing' => false,
            'rules' => [
                # Note: camelCase model Controller isn't working here
                '/admin' => 'backend/dashboard',
                # Guests
                '/admin/guests' => 'backend/registration',
                '/admin/guests/add' => 'backend/registration/add',
                '/admin/guests/<guestId:\d+>/edit' => 'backend/registration/edit',
                '/admin/guests/<guestId:\d+>/view' => 'backend/registration/view',
                '/admin/guests/<guestId:\d+>/delete' => 'backend/registration/delete',
                # Events
                '/admin/events' => 'backend/event',
                '/admin/events/create' => 'backend/event/create',
                '/admin/events/<eventId:\d+>/view' => 'backend/event/view',
                '/admin/events/<eventId:\d+>/edit' => 'backend/event/edit',
                '/admin/events/<eventId:\d+>/delete' => 'backend/event/delete',
                '/admin/events/<eventId:\d+>/unpublish' => 'backend/event/unpublish',
                '/admin/events/<eventId:\d+>/publish' => 'backend/event/publish',
                # Reports
                '/admin/reports' => 'backend/report',
                '/admin/reports/export-to-excel' => 'backend/report/exporttoxcel',
                #'/admin/reports/<page:\d+>/page' => 'backend/report',
                # Registered Event
                # camelcase not working
                #'/admin/registration-events/index' => 'backend/registrationEvent',
                '/admin/registration-events/<id:\d+>/delete-guest-event' => 'backend/registrationevent/deleteguestevent',
                '/admin/registration-events/<id:\d+>/delete-event-guest' => 'backend/registrationevent/deleteeventguest',
            ],
        ],
        // 'behaviors'=>array(
        //     'runEnd'=>array(
        //         'class'=>'app\components\WebApplicationEndBehavior',
        //     ),
        // ),
        
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
