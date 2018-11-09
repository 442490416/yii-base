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
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    protected function _createToken()
    {
        $token = uniqid('ddasdfasdfas32sdfa');
        SessionHelper::set('token',$token);

        $secretToken = \Yii::$app->mcrypt->encrypt($token);
        SessionHelper::set($this->tokenKey,$secretToken);
    }

    /**
     * @return bool
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    protected function _validateToken()
    {
        $token = SessionHelper::get('token');
        if(empty($token)) {
            return false;
        }

        $secretToken = SessionHelper::get($this->tokenKey);
        if(empty($secretToken)) {
            return false;
        }

        return $secretToken === \Yii::$app->mcrypt->encrypt($token);
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
        $model->password      = $this->_encryptPassword($password);
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

        $this->password = $this->_encryptPassword($this->password);

        $this->userInfo = AdminUser::find()
            ->where([
                'user_name' => $this->userName,
                'password'  => $this->password
            ])
            ->one();

        if(!($this->userInfo)) {
            return false;
        }

        //更新数据库
        $this->userInfo->last_login_ip = ComHelper::getClientIp();
        $this->userInfo->update_time   = time();
        $this->userInfo->save();

        /**
         * 删除敏感信息
         */
        unset($this->password,$this->userInfo->password);

        //持久化token
        $this->_createToken();
        //登录信息持久化
        SessionHelper::set($this->loginSessionKey,serialize($this->userInfo));

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

        $result = $this->_validateToken();
        if(!$result) {
            return false;
        }

        $userInfo = SessionHelper::get($this->loginSessionKey);
        if(empty($userInfo)) {
            return false;
        }

        $this->userInfo = unserialize($userInfo);

        return true;
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