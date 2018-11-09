<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/9
 * Time: 下午9:13
 */

namespace common\mcrypts;

/**
 * Class Mcrypt
 * @package common\mcrypt
 * User Jiang Haiqiang
 */
abstract class Mcrypt
{
    /**加密
     * @param string $data
     * @return string
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    abstract public function encrypt($data);

    /**解密
     * @param string $data
     * @return string
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    abstract public function decrypt($data);
}