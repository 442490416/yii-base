<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/9
 * Time: 下午9:42
 */

namespace common\service;


use common\base\Service;

/**
 * Class Login
 * @package common\service
 * User Jiang Haiqiang
 */
abstract class Login extends Service
{
    /**
     * @var    string
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public $userName;

    /**
     * @var   string
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public $password;

    /**
     * @var string
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public $salt = 'asdfasd233￥dfsff';

    /**
     * @return string
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    protected function _encryptPassword($password)
    {
        $encrypt = \Yii::$app->mcrypt->encrypt($password);
        return md5($encrypt.md5($encrypt.$this->salt));
    }

    /**
     * @return bool
     * Author: Jiang Haiqiang
     * Email : jhq0113@163.com
     * Date: 2018/11/5
     * Time: 15:04
     */
    abstract public function login();

    /**
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    abstract public function logout();

    /**
     * @return bool
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    abstract public function isLogin();

    /**
     * @return array
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    abstract public function loginInfo();
}