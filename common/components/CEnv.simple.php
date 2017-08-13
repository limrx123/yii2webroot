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

     //数据库配置
     const DB_HOST = '192.168.10.2';
     const DB_PORT = '3306';
     const DB_NAME = 'ypt';
     const DB_USERNAME = 'root';
     const DB_PASSWORD = 'youpenet';
     const DB_CHARSET = 'utf8';

     //子域名部署配置
     const APP_DEAULT_DOMAIN_MAP = 'frontend';  //必要配置项
     //开关子域名部署
     const APP_SUB_DOMAIN_DEPLOY = true;        //必要配置项
     //子域名部署规则
     const APP_SUB_DOMAIN_MAP =[               //非必要，可为空
          self::HOST => 'frontend',
          self::HOST_WWW => 'frontend',
          self::HOST_ADMIN => 'backend'
     ];

}