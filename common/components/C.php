<?php
/**
 * Created by PhpStorm.
 * User: zz
 * Date: 2017/8/8
 * Time: 15:15
 */
//定义应用根路径
defined('ROOT_PATH') or define('ROOT_PATH',dirname(dirname(__DIR__)));
//定义请求域名
define('HTTP_HOST', !empty($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : $_SERVER['HTTP_HOST']);
//加载环境应用变量
require_once(ROOT_PATH.'/common/components/CEnv.php');

final class C extends CEnv
{
    //初始化子域名配置路径
    private static function _init(){
        $subdomain = [];
        defined("C::APP_SUB_DOMAIN_MAP") && $subdomain = C::APP_SUB_DOMAIN_MAP;
        //子域名部署
        if(C::APP_SUB_DOMAIN_DEPLOY && (isset($subdomain[HTTP_HOST]) && $subdomain[HTTP_HOST])){
              //开启
            $app_path = ROOT_PATH.'/'.$subdomain[HTTP_HOST];
        }else{
            //未开启或者未配置该请求子域名
            $app_path = ROOT_PATH.'/'.C::APP_DEAULT_DOMAIN_MAP;
        }
        unset($config,$subdomain);
        return $app_path;
    }
    //加载run运行配置数组
    public static function loadConfig(){
        $app_path = self::_init();
        //载入框架文件
        require(ROOT_PATH . '/vendor/autoload.php');
        require(ROOT_PATH . '/vendor/yiisoft/yii2/Yii.php');
        //载入公共主启动配置
        require(ROOT_PATH . '/common/config/bootstrap.php');
        //载入子域名/默认启动配置
        require($app_path . '/config/bootstrap.php');
        //主配置
        return yii\helpers\ArrayHelper::merge(
            require(ROOT_PATH . '/common/config/main.php'),
            require($app_path . '/config/main.php')
        );

    }

    private static function preLoad(){
        //将引入和配置文件一次写入文件，并压缩空白字符，生成一次性载入框架文件
    }


}