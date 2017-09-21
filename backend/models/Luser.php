<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/21
 * Time: 14:06
 */

namespace backend\models;


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

     public static function findIdentity($id){

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

     public static function validatePassword(){
          
     }

     public static function setPassword(){

     }

     public static function findByUsername(){

     }

     public static function findByAccessToken(){

     }

     public static function findByUnionId(){

     }

}