<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/2
 * Time: 下午11:07
 */

namespace common\helpers;

/**
 * Class ComHelper
 * @package common\helpers
 * User Jiang Haiqiang
 */
class ComHelper
{
    /**
     * @param string $key
     * @param array  $data
     * @param string $defaultValue
     * @return string
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public static function fStr($key,$data=[],$defaultValue='')
    {
        if(!isset($data[ $key ])) {
            return $defaultValue;
        }

        return addslashes(trim($data[ $key ]));
    }

    /**
     * @param string $key
     * @param array  $data
     * @param int $defaultValue
     * @return int
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public static function fInt($key,$data=[],$defaultValue=0)
    {
        if(!isset($data[ $key ])) {
            return $defaultValue;
        }
        return (int)trim($data[ $key ]);
    }

    /**
     * @param string $key
     * @param array  $data
     * @param int $defaultValue
     * @return float|int
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public static function fFloat($key,$data=[],$defaultValue=0.00)
    {
        if(!isset($data[ $key ])) {
            return $defaultValue;
        }
        return (float)trim($data[ $key ]);
    }

    /**
     * @return bool
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public static function isCli()
    {
        return PHP_SAPI === 'cli';
    }

    /**获取客户端ip
     * @param bool $long             是否转换为long值型ip
     * @return bool|string
     * @date  : 2017/12/26
     * @time  : 10:49
     * @author: Jiang Haiqiang
     * @email :  jhq0113@163.com
     */
    public static function getClientIp($long=true)
    {
        $ip = '127.0.0.1';
        if(!self::isCli()) {
            if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = explode(',',$_SERVER['HTTP_X_FORWARDED_FOR']);
                return $ip[0];
            } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
        }

        return $long ? ip2long($ip) : $ip;
    }
}