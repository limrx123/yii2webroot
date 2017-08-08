<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
define('HTTP_HOST', !empty($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : $_SERVER['HTTP_HOST']);
//环境参数类
require(dirname(__DIR__).'/common/components/C.php');
//子域名部署 待优化
$subdomain = require(dirname(__DIR__).'/common/config/deploy/subdomain.php');
//应用路径
$app_path = (isset($subdomain[HTTP_HOST]) && $subdomain[HTTP_HOST])?$subdomain[HTTP_HOST]:null;  //默认路径配置

//框架配置
require(ROOT_PATH . '/vendor/autoload.php');
require(ROOT_PATH . '/vendor/yiisoft/yii2/Yii.php');
require(ROOT_PATH . '/common/config/bootstrap.php');

if($app_path)
	require($app_path . '/config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(ROOT_PATH . '/common/config/main.php'),
    $app_path?require($app_path . '/config/main.php'):[]
);


(new yii\web\Application($config))->run();
