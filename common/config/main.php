<?php
return [
    //'class' => 'Yii\web\application'  //配置都遵行 类名+构造参数 形式，此处 （new Yii\web\application()->run()）,无需使用Yii::createObject($config)
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
         'request' => [
              // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
              'cookieValidationKey' => 'KrA1AsrW5xQsR7otTfL0w5ZEiN2y49ux',
         ],
         'assetManager' => [
              'basePath' => '@static',
              'appendTimestamp' => true,
              //'baseUrl' => C::SITE_STATIC,
              'bundles' => [
                   //'yii\bootstrap\BootstrapPluginAsset' => false,//禁用bootstrap.js
                   //'yii\web\JqueryAsset' => false, //禁用jquery(jquery.js)
                   //'yii\bootstrap\BootstrapAsset' => false,//禁用bootstrap.css
              ],
         ],
         'db' => [
             'class' => 'yii\db\Connection',
             'dsn' => 'mysql:host=192.168.10.2;dbname=ypt',
             'username' => 'root',
             'password' => 'youpenet',
             'charset' => 'utf8',
         ]
    ],
];
