<?php
return [
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
              'baseUrl' => C::SITE_STATIC,
              'bundles' => [
                   //'yii\bootstrap\BootstrapPluginAsset' => false,//禁用bootstrap.js
                   //'yii\web\JqueryAsset' => false, //禁用jquery(jquery.js)
                   //'yii\bootstrap\BootstrapAsset' => false,//禁用bootstrap.css
              ],
         ],
         //'db' => []
    ],
];
