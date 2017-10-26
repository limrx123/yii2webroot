<?php
/**
 * Created by PhpStorm.
 * User: limr
 * Date: 2017/10/26
 * Time: 22:30
 */

namespace common\components;


use yii\base\Component;

class TestEvent extends Component
{
     const TEST_EVENT_BEFORE_RUN = 'BeforeRun';
     const TEST_EVENT_AFTER_RUN = 'AfterRun';


     public function run(){
          if($this->beforeRun()){
               $run = '[DATA-RUN()]';
               echo "<br>==== {$run} is running.======<br>";
               $this->afterRun($run);
          }
     }


     public function beforeRun(){
          $this->trigger(self::TEST_EVENT_BEFORE_RUN,null);
          return true;
     }

     public function afterRun($run){
          $event = new TestEventModel();
          $event->data = $run;
          $this->trigger(self::TEST_EVENT_AFTER_RUN,$event);
     }

     public function getName(){
          echo "<br>====event_sender_name:[".get_called_class()."]====<br>";
     }

}