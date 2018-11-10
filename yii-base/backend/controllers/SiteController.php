<?php
namespace backend\controllers;

use backend\service\Login;
use common\helpers\ComHelper;
use Yii;
use yii\captcha\CaptchaAction;
use common\base\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'maxLength'=>10,
                'minLength'=>6,
                'padding'=>5,
                'height'=>40,
                'width'=>300,
                'offset'=>3,
                //'fontFile' => ''
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
        if(\Yii::$app->login->isLogin()) {
            return $this->render('index');
        }
        return $this->redirect(['/site/login']);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $war = '';
        if(\Yii::$app->request->isPost){
            /**
             * @var Login $login
             */
            $login = \Yii::$app->login;
            $userName = ComHelper::fStr('user_name',$_POST);
            $password = ComHelper::fStr('password',$_POST);
            $verify   = ComHelper::fStr('captcha',$_POST);

            $login->userName = $userName;
            $login->password  = $password;

            if(!empty($login->password)) {
                $login->password = \Yii::$app->mcrypt->decrypt($login->password);
            }

            if(empty($verify)) {
                return $this->renderPartial('login', [
                    'war' => '验证码必填',
                ]);
            }

            /**
             * @var CaptchaAction $captchaAction
             */
            $captchaAction = $this->createAction('captcha');
            $result = $captchaAction->validate($verify,false);

            if(!$result) {
                return $this->renderPartial('login', [
                    'war' => '验证码错误',
                ]);
            }

            /**
             * 登录
             */
            $result = $login->login();
            if($result) {
                return $this->redirect(['/site/index']);
            }

            $war = '用户名或者密码错误';
        }

        return $this->renderPartial('login', [
            'war'   => $war,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->login->logout();

        return $this->redirect(['/site/login']);
    }
}
