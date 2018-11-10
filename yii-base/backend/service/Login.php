<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/9
 * Time: 下午9:55
 */

namespace backend\service;


use backend\models\AdminUser;
use common\helpers\ComHelper;
use common\helpers\SessionHelper;

/**
 * Class Login
 * @package backend\service
 * User Jiang Haiqiang
 */
class Login extends \common\service\Login
{
    /**
     * @var string
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public $loginSessionKey = 'login';

    /**
     * @var string
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public $tokenKey = 'tokenKey';

    /**
     * @var AdminUser
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public $userInfo;

    /**
     * @param $userId
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    protected function _createToken($userId)
    {
        SessionHelper::set($this->tokenKey,uniqid($userId.'|'));
    }

    /**
     * @return int
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    protected function _validateToken()
    {
        $token = SessionHelper::get($this->tokenKey);
        if(empty($token)) {
            return false;
        }

        $token = explode('|',$token);

        return (int)$token[0];
    }

    /**
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    protected function _filterDangerInfo()
    {
        /**
         * 删除敏感信息
         */
        unset($this->password,$this->userInfo->password);
    }

    /**
     * @param string $userName
     * @param string $password
     * @return bool
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public function regis($userName,$password)
    {
        $model = new AdminUser();
        $model->user_name     = $userName;
        $model->password      = $this->encryptPassword($password);
        $model->update_time   = time();
        $model->last_login_ip = ComHelper::getClientIp();
        return $model->save();
    }

    /**
     * @return bool
     * Author: Jiang Haiqiang
     * Email : jhq0113@163.com
     * Date: 2018/11/5
     * Time: 15:04
     */
    public function login()
    {
        if(!isset($this->userName) || empty($this->userName)) {
            return false;
        }

        if(!isset($this->password) || empty($this->password)) {
            return false;
        }

        $password = $this->encryptPassword($this->password);

        $this->userInfo = AdminUser::find()
            ->where([
                'user_name' => $this->userName,
                'password'  => $password,
                'is_on'     => '1'
            ])
            ->one();

        if(!($this->userInfo)) {
            return false;
        }

        //更新数据库
        $this->userInfo->last_login_ip = ComHelper::getClientIp();
        $this->userInfo->update_time   = time();
        $this->userInfo->save();

        $this->_filterDangerInfo();

        //持久化token
        $this->_createToken($this->userInfo->id);

        //操作日志
        \Yii::$app->operator->log(OperateLog::LOGIN);

        return true;
    }

    /**
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public function logout()
    {
        SessionHelper::destroy();
        SessionHelper::deleteAll();
        unset($this->userInfo);
    }

    /**
     * @return bool
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public function isLogin()
    {
        // TODO: Implement isLogin() method.
        if(!empty($this->userInfo)) {
            return true;
        }

        $userId = $this->_validateToken();
        if($userId < 1) {
            return false;
        }

        $this->userInfo = AdminUser::find()->where([
            'id'    => $userId,
            'is_on' => '1'
        ])->one();

        if($this->userInfo instanceof AdminUser) {

            $this->userName = $this->userInfo->user_name;
            $this->_filterDangerInfo();

            return true;
        }

        return false;
    }

    /**
     * @return AdminUser|bool
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public function loginInfo()
    {
        // TODO: Implement loginInfo() method.
        if($this->isLogin()) {
            return $this->userInfo;
        }

        return false;
    }
}