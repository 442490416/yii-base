<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/9
 * Time: 下午10:01
 */

namespace common\helpers;

/**
 * Class SessionHelper
 * @package common\helpers
 * User Jiang Haiqiang
 */
class SessionHelper
{
    /**
     * @param string $key
     * @param string $value
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    static public function set($key,$value)
    {
        if(!empty($value)) {
            $value = \Yii::$app->mcrypt->encrypt($value);
        }

        return \Yii::$app->session->set($key,$value);
    }

    /**
     * @param string $key
     * @param string $defaultValue
     * @return mixed
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    static public function get($key,$defaultValue='')
    {
        $value = \Yii::$app->session->get($key,$defaultValue);
        if(!empty($value)) {
            $value = \Yii::$app->mcrypt->decrypt($value);
        }

        return $value;
    }

    /**
     * @param string $key
     * @return mixed
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    static public function delete($key)
    {
        return \Yii::$app->session->remove($key);
    }

    /**
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    static public function deleteAll()
    {
        return \Yii::$app->session->removeAll();
    }

    /**
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    static public function destroy()
    {
        return \Yii::$app->session->destroy();
    }

    /**
     * @param string $key
     * @param string $value
     * @param bool   $removeAfterAccess
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    static public function flash($key,$value,$removeAfterAccess=true)
    {
        return \Yii::$app->session->setFlash($key,$value,$removeAfterAccess);
    }

    /**
     * @param string $key
     * @param string $defualtValue
     * @param bool $delete
     * @return mixed
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    static public function getFlash($key,$defualtValue='',$delete=false)
    {
        return \Yii::$app->session->getFlash($key,$defualtValue,$delete);
    }

    /**
     * @param string $key
     * @return bool
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    static public function hasFlash($key)
    {
        return \Yii::$app->session->hasFlash($key);
    }

    /**
     * @param string $msg
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    static public function success($msg='操作成功')
    {
        return self::flash('success',$msg);
    }

    /**
     * @param string $msg
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    static public function error($msg='操作失败')
    {
        return self::flash('error',$msg);
    }

    /**
     * @param string $msg
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    static public function danger($msg='')
    {
        return self::flash('danger',$msg);
    }

    /**
     * @param string $msg
     * @return mixed
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    static public function info($msg='')
    {
        return self::flash('info',$msg);
    }

    /**
     * @param string $msg
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    static public function warning($msg='')
    {
        return self::flash('warning',$msg);
    }
}