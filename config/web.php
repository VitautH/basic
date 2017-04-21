<?php
use app\models\User;
$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        /*
         * Вызов метода проверки доступа и редиректа в админку
         */
        'user' => [
            'class' => 'dektrium\user\Module',
            'controllerMap' => [
                'security' => [
                    'class' => \dektrium\user\controllers\SecurityController::className(),
                    'on ' . \dektrium\user\controllers\SecurityController::EVENT_AFTER_LOGIN => function ($e) {

                        $user_role =  Yii::$app->user->identity->role_id;
                        $user = new User;
                        switch ($user_role) {
                            case $user::ADMIN:
                                Yii::$app->response->redirect('/admin');
                                Yii::$app->end();
                                break;

                            case $user::BUYER:
                                Yii::$app->response->redirect('/account');
                                Yii::$app->end();
                                break;

                            case $user::MANAGER:

                                Yii::$app->response->redirect('/manager');
                                Yii::$app->end();
                                break;

                        }



                    },
                ],
            ],
        ],
        'admin' => [
            'class' => 'app\modules\admin\Admin',
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'xqU70zFOHQMeMTNlxDc8VSNPhp6G1b7d',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
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
        'db' => require(__DIR__ . '/db.php'),

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'login'=> 'user/security/login',
                'logout'=> 'user/security/logout',
            ],
        ],
        
    ],
    'aliases' => [
        '@img_path' => 'uploads/images',
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
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
