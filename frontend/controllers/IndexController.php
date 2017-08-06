<?php
/**
 * Created by PhpStorm.
 * User: limr
 * Date: 2017/8/7
 * Time: 0:37
 */

namespace frontend\controllers;


use yii\web\Controller;

class IndexController extends Controller
{
    public $layout = false;
    public function actionIndex()
    {
        return $this->render('index');
    }
}