<?php
/**
 * Created by PhpStorm.
 * User: limr
 * Date: 2017/10/26
 * Time: 22:41
 */

namespace common\components;


use yii\base\Event;

class TestEventModel extends Event
{
     public $receiveData;

     public function getName(){
          echo "<br>====event_model_name:[".get_called_class()."]====<br>";
     }
}