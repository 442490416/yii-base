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
use backend\service\Right;
use common\helpers\ErrorHelper;
use common\helpers\SessionHelper;
use yii\db\ActiveRecord;

/**
 * Class Controller
 * @package backend\controllers
 * User Jiang Haiqiang
 */
abstract class Controller extends \common\base\Controller
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

        $access = Right::self()->checkAccess();

        if(!$access) {
            if(\Yii::$app->request->getIsAjax()) {
                $this->response(ErrorHelper::$ERROR_FORBIDDEN);
            }

            SessionHelper::warning('权限不够');

            $html = $this->render('@backend/views/site/error',[
                'name'     => '权限不够',
                'message'  => '权限不够'
            ]);

            exit($html);
        }

        return $access;
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

    /**
     * @param $id
     * @return ActiveRecord|null
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    protected function findModel($id)
    {

    }

    /**
     * @param $id
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public function actionRemove($id)
    {
        $model = $this->findModel($id);
        if($model) {
            if($model->is_on == 1) {
                $model->is_on = '0';
            }else{
                $model->is_on = '1';
            }
            $model->save();

            SessionHelper::success();
        }

        return $this->redirect(['index']);
    }
}