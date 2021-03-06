<?php
namespace backend\controllers;

use backend\models\Luser;
use common\models\User;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\RegisterForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'register'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $data['user'] = Yii::$app->user->identity;
        return $this->render('index', $data);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $request = Yii::$app->request;
        $post = $request->post();

//        echo "<pre>";
//        print_r($post);
//        die;

        if (!Yii::$app->user->isGuest) {
            //return $this->goHome();
        }

        $model = new LoginForm();
        //echo '<pre>';
        //$model->load(Yii::$app->request->post());
        //print_r($model->password);
        //die;
        if ($model->load(Yii::$app->request->post()) && $model->defaultLogin()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionRegister(){
        $request = Yii::$app->request;
        $post = $request->post();

        /*echo '<pre>';
        print_r($post);
        die;*/

        $model = new RegisterForm();  //接受登录或注册的数据模型 extends model
        $load = $model->load($post);
        if($load && $model->validate()){

            //$userModel = new User();    //extends AR-model implements IdentityInterface
            $userModel = new Luser();
            $userModel->username = $model->username;
            $userModel->password_hash = $userModel->generatePasswordHash($model->password);
            $userModel->created_at = time();
            $userModel->auth_key = $userModel->generateRandomString();
            $userModel->password_reset_token = $userModel->generateRandomString().'_'.time();
            $userModel->password = $userModel->setPassword($model->password);
            $userModel->email = '';
            if($userModel->validate()){
                $id = $userModel->save();
                if($id){
                    //Yii::$app->user->login($userModel->findByUsername($model->username), 0);
                    $userModel->saveLoginUser2Redis($userModel->findByUsername($model->username));
                    $this->redirect('/');
                }
            }else{
                $model->addError('error','注册失败');   // 复写addError getError  支持注册错误标识，并显示制定标识的错误
            }

        }else{
            //$model->addError('re_password','重复密码格式错误');
            $model->getFirstError('error');
            echo 'validate failed.';
        }
        return $this->render('register',[
            'model' => $model
        ]);

    }



}
