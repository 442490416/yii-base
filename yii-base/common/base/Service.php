<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/9
 * Time: 下午9:42
 */

namespace common\base;

/**
 * Class Service
 * @package common\base
 * User Jiang Haiqiang
 */
abstract class Service
{
    /**实例池
     * @var array
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    static private $_pool = [];

    /**
     * @return static
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    static public function self()
    {
        $class = get_called_class();
        if(!isset(self::$_pool[ $class ])) {
            $instance = new $class();
            self::$_pool[ $class ] = $instance;
        }

        return self::$_pool[ $class ];
    }
}