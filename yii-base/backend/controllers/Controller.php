<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/10
 * Time: 下午2:52
 */

namespace backend\controllers;

use backend\models\AdminUser;
use backend\service\Login;
use common\helpers\ErrorHelper;

/**
 * Class Controller
 * @package backend\controllers
 * User Jiang Haiqiang
 */
class Controller extends \common\base\Controller
{
    /**
     * @var AdminUser
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public $userInfo;

    /**
     * @param $action
     * @return bool|\yii\web\Response
     * @throws \yii\web\BadRequestHttpException
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public function beforeAction($action)
    {
        $result = parent::beforeAction($action);
        if(!$result) {
            return false;
        }

        /**
         * @var Login $login
         */
        $login = \Yii::$app->login;

        if(!$login->isLogin()) {
            if(\Yii::$app->request->isAjax) {
                $this->response(ErrorHelper::$ERROR_NOT_LOGIN);
            }
            return $this->redirect(['/site/login']);
        }

        $this->userInfo = $login->userInfo;

        return true;
    }

    /**
     * @param array $config
     * @param mixed $data
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public function response($config,$data=[])
    {
        $response = ErrorHelper::response($config,$data);
        \Yii::$app->response->send();
        exit(json_encode($response,JSON_UNESCAPED_UNICODE));
    }
}