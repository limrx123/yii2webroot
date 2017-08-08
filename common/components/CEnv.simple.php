<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/8
 * Time: 15:21
 */

class CEnv
{
     //环境参数
     const HOST = 'yii2webroot.com';
     const HOST_WWW = 'www.yii2webroot.com';
     const HOST_ADMIN = 'admin.yii2webroot.com';
     const SITE_WWW = 'http://www.yii2webroot.com';
     const SITE_ADMIN = 'http://admin.yii2webroot.com';
     const SITE_STATIC = 'http://static.yii2webroot.com';


     //子域名部署配置
     const APP_DEAULT_DOMAIN_MAP = 'frontend';  //必填
          //开关子域名部署
     const APP_SUB_DOMAIN_DEPLOY = true;
          //子域名部署规则
     const APP_SUB_DOMAIN_MAP =[               //可为空
          self::HOST => 'frontend',
          self::HOST_WWW => 'frontend',
          self::HOST_ADMIN => 'backend'
     ];

}