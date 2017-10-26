<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')
);

$config = [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'defaultRoute' => 'index',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            //'identityClass' => 'common\models\User',
            'identityClass' => 'backend\models\Luser',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
         'redis' => [
              'class' => 'yii\redis\Connection',
              'hostname' => \C::REDIS_HOST,
              'port' => \C::REDIS_PORT,
              'password' => \C::REDIS_PASS,
              'database' => \C::REDIS_DATA_BASE,
         ],
         'session' => [
              // this is the name of the session cookie used for login on the backend
              'name' => 'youpenet',
              'cookieParams' => ['path' => '/', 'domain' => \C::SESSION_DOMAIN],  //还可以设置`lifetime`, `path`, `domain`, `secure` and `httponly`
         ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'assetManager' => [
            'basePath' => '@static',
            'appendTimestamp' => true,
            'baseUrl' => C::SITE_STATIC,
            'bundles' => [
                //'yii\bootstrap\BootstrapPluginAsset' => false,//禁用bootstrap.js
                //'yii\web\JqueryAsset' => false, //禁用jquery(jquery.js)
                //'yii\bootstrap\BootstrapAsset' => false,//禁用bootstrap.css
            ],
        ],
    ],
    'params' => $params,
];

if(YII_ENV === 'dev'){
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
