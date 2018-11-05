<?php
namespace backend\controllers;

use backend\models\AdminUser;
use common\helpers\ComHelper;
use Yii;
use yii\captcha\CaptchaAction;
use yii\web\Controller;
use common\models\LoginForm;

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
        return $this->redirect(['/site/login']);
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $war = '';
        $model = new AdminUser();
        if(\Yii::$app->request->isPost){
            $verify   = ComHelper::fStr('captcha',$_POST);
            if(empty($verify)) {
                return $this->renderPartial('login', [
                    'war' => '验证码必填',
                ]);
            }

            /**
             * @var CaptchaAction $captchaAction
             */
            $captchaAction = $this->createAction('yii\captcha\CaptchaAction');
            $result = $captchaAction->validate($verify,false);

            if(!$result) {
                return $this->renderPartial('login', [
                    'war' => '验证码错误',
                ]);
            }

            $userName = ComHelper::fStr('userName',$_POST);
            $password = ComHelper::fStr('password',$_POST);

        }

        return $this->renderPartial('login', [
            'model' => $model,
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
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
