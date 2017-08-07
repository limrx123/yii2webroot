<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

defined('ROOT_PATH') or define('ROOT_PATH',dirname(__DIR__));
define('HTTP_HOST', !empty($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : $_SERVER['HTTP_HOST']);
$subdomain = require(ROOT_PATH.'/common/config/deploy/subdomain.php');
$app_path = (isset($subdomain[HTTP_HOST]) && $subdomain[HTTP_HOST])?$subdomain[HTTP_HOST]:null;


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
