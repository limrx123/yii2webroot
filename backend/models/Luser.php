<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/21
 * Time: 14:06
 */

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Luser extends ActiveRecord implements IdentityInterface
{
     public static function tableName(){
          return '{{%user}}';
     }

     public function rules()
     {
          return [];
     }

     /**
      * @inheritdoc
      */
     public static function findIdentity($id)
     {
          return static::findOne(['id' => $id]);
     }

     public static function findIdentityByAccessToken($token, $type = null){

     }

     public function getId(){
          return $this->getPrimaryKey();
     }

     public function getAuthKey(){

     }

     public function validateAuthKey($authKey){

     }

     public static function validatePassword($username, $vpassword){
          $user = self::findByUsername($username);
          if(!$user){
               return false;
          }
          $pass = $user->password;
          $vpass = self::setPassword($vpassword);

          return $pass == $vpass;
     }

     public static function setPassword($password){
          return md5($password.\C::LOGIN_SALT);
     }

     public static function findByUsername($username){
          return self::findOne(['username'=>strval($username)]);
     }

     public static function findByMobile($mobile){
          return self::findOne(['mobile'=>strval($mobile)]);
     }

     public static function findByAccessToken($token){
          //redis  从redis 获取用户信息
          //return self::findOne(['mobile'=>strval($token)]);
          $redis = Yii::$app->redis;
          return $redis->get($token);
     }

     public static function findByOpenId($openid, $type){
          //type  标识第三方登录类型

     }

     public static function generatePasswordHash($password){
          return Yii::$app->security->generatePasswordHash($password);
     }

     public static function generateRandomString(){
          return Yii::$app->security->generateRandomString();
     }

     public static function setAccessToken(){
          return self::generateRandomString();
     }

     public static function saveLoginUser2Redis($user){
          if($user){
               Yii::$app->redis->set('login_', serialize($user));
          }
     }

     public static function saveOpenkey2Redis($uid){

     }

}