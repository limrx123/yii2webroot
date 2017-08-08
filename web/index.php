<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

//载入run运行配置
require(dirname(__DIR__).'/common/components/C.php');
$config = C::loadConfig();

(new yii\web\Application($config))->run();
