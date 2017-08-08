<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@static';
    public $baseUrl = \C::SITE_STATIC;
    public $css = [
        'backend/css/site.css',
    ];
    public $js = [
    ];
    public $depends = [
         'yii\bootstrap\BootstrapPluginAsset',
         'yii\bootstrap\BootstrapAsset'
    ];
}
