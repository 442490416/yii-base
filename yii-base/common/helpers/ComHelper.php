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
}