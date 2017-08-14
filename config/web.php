<?php

use app\models\User;

$params = require(__DIR__ . '/params.php');
require(__DIR__ . '/../helpers/helpers.php');
$config = [
    'sourceLanguage' => 'ru',
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'imagemanager' => [
            'class' => 'noam148\imagemanager\Module',
            //set accces rules ()
            'canUploadImage' => true,
            'canRemoveImage' => function () {
                return true;
            },
            //add css files (to use in media manage selector iframe)
            'cssFiles' => [
                'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css',
            ],
        ],
        /*
         * Вызов метода проверки доступа и редиректа в админку
         */
        'user' => [
            'class' => 'dektrium\user\Module',
            'controllerMap' => [
                'security' => [
                    'class' => \dektrium\user\controllers\SecurityController::className(),
                    'on ' . \dektrium\user\controllers\SecurityController::EVENT_AFTER_LOGIN => function ($e) {

                        $user_role = Yii::$app->user->identity->role_id;
                        $user = new User;
                        switch ($user_role) {
                            case $user::ADMIN:
                                Yii::$app->response->redirect('/admin');
                                Yii::$app->end();
                                break;

                            case $user::BUYER:
                                Yii::$app->response->redirect(Yii::$app->request->referrer);
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
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'css' => ['css/bootstrap.css'],
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'xqU70zFOHQMeMTNlxDc8VSNPhp6G1b7d',
        ],
        'i18n' => [
            'class' => 'app\components\Lang',
        ],
        'bepaid' => [
            'class' => 'app\components\Bepaid',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'imagemanager' => [
            'class' => 'noam148\imagemanager\components\ImageManagerGetPath',
            //set media path (outside the web folder is possible)
            // 'mediaPath' => '/app/web/uploads/images/',
            'mediaPath' => 'uploads/images/',
            //path relative web folder to store the cache images
            //  'cachePath' => 'assets/images',
            //use filename (seo friendly) for resized images else use a hash
            'useFilename' => true,
            //show full url (for example in case of a API)
            'absoluteUrl' => false,
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

//        'notifyPayment'=> [
//            'class'=>'app\models\Order'
//        ],


        'db' => require(__DIR__ . '/db.php'),

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/login' => 'login/login',
                '/logout' => 'user/security/logout',
                '/registration' => 'registration/index',
                '/<lang:en|ru>/about' => 'site/about',
                '/<lang:en|ru>/contact' => 'site/contact',
                '/<lang:en|ru>/page/<slug>' => 'pages/view',
                '/<lang:en|ru>' => 'site/index',
                '/<lang:en|ru>/products' => 'products',
                '/<lang:en|ru>/products/view' => 'products/view',
                '/<lang:en|ru>/articles/view' => 'articles/view',
                '/<lang:en|ru>/articles' => 'articles/index',
                '/<lang:en|ru>/account/profile' => 'account/profile',
                '/<lang:en|ru>/account' => 'account/index',
                '/<lang:en|ru>/casino' => 'casino/index',
                '/<lang:en|ru>/casino/view' => 'casino/view',
                '/<lang:en|ru>/manager' => 'manager/index',
                '/<lang:en|ru>/manager/check-sms_code' => 'manager/check-sms_code',
                '/switch/<lang>' => 'lang/change',
                '/order-hide/<slug>' => 'account/coupon-hide',
                '/order/filter' => 'account/filter',
                // '/<lang:en|ru>/<slug:\w+>.html' => 'page/page-view',
            ],
        ],

    ],
    'aliases' => [
        '@img_path' => 'uploads/images',
        '@common' => '/common/'
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