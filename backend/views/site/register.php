<?php
/**
 * Created by PhpStorm.
 * User: limr
 * Date: 2017/8/12
 * Time: 12:53
 */

use backend\models\RegisterForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '注册';
$this->params['breadcrumbs'][] = $this->title;   //视图模型  开放的属性 params 可以注入参数 视图模板不管布局还是页面都可以直接使用  直接$this->属性 报错

?>

<div class="site-register">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>请填写注册信息:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'register-form']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 're_password')->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton('注册', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
