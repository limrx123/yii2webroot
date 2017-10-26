<?php


use common\components\TestEvent;

echo Yii::getAlias('@static');
echo "<br>";

var_dump(Yii::getAlias('@web'));

$testevent = new TestEvent();

$testevent->on(TestEvent::TEST_EVENT_BEFORE_RUN,function($event){
     echo "<pre>";
     echo get_class($event);
     echo "<br>=====[TEST_EVENT_BEFORE_RUN] is exec ======<br>";
     return false;
});

$testevent->on(TestEvent::TEST_EVENT_AFTER_RUN,function($event){
     echo "<br>=====[TEST_EVENT_AFTER_RUN] is exec ======<br>";
     echo "<br>===data:[".$event->data."]====<br>";
     echo $event->getName();
     echo $event->sender->getName();
},1);

$testevent->run();




?>
<br>
<hr>
我是后台