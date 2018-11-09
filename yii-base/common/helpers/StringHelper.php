<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/9
 * Time: 下午11:10
 */

namespace common\helpers;

/**
 * Class StringHelper
 * @package common\helpers
 * User Jiang Haiqiang
 */
class StringHelper extends \yii\helpers\StringHelper
{
    /**下划线分割转驼峰
     * @example
     *
     * $column ='user_name';
     * $result = StringHelper::tuoFeng2Line($column);
     * 结果为：userName
     *
     * @param string $str             字符串
     * @param bool   $ucFirst         true为大驼峰，false小驼峰
     * @return mixed|string
     * @date  : 2017/12/26
     * @time  : 10:53
     * @author: Jiang Haiqiang
     * @email :  jhq0113@163.com
     */
    public static function line2TuoFeng($str,$ucFirst=false)
    {
        $str = ucwords(str_replace('_', ' ', $str));
        $str = str_replace(' ','',lcfirst($str));
        return $ucFirst ? ucfirst($str) : $str;
    }

    /**小驼峰变下划线
     * @example
     *
     * $column ='userName';
     * $result = StringHelper::tuoFeng2Line($column);
     * 结果为：user_name
     *
     * @param string $str
     * @return string
     * @date  : 2017/12/26
     * @time  : 10:52
     * @author: Jiang Haiqiang
     * @email :  jhq0113@163.com
     */
    public static function tuoFeng2Line($str)
    {
        $str = preg_replace_callback('/([A-Z]{1})/',function($matches){
            return '_'.strtolower($matches[0]);
        },$str);
        return ltrim($str,'_');
    }

    /**用上下文信息替换记录信息中的占位符
     * @example
     *
     * $message = '转账:账户{id}出现异常';
     * $context = [ 'id' => 56 ];
     *
     * $message = StringHelper::interpolate($message,$context);
     *
     * @param string $message          带占位符的字符串
     * @param array  $context          占位符数组
     * @return string
     * @date  : 2018/1/19
     * @time  : 13:43
     * @author: Jiang Haiqiang
     * @email :  jhq0113@163.com
     */
    public static function interpolate($message, array $context = [])
    {
        $replace = [];
        foreach ($context as $key => $val) {
            $replace['{' . $key . '}'] = $val;
        }
        // 替换记录信息中的占位符，最后返回修改后的记录信息。
        return strtr($message, $replace);
    }

    /**
     * 生成随机数
     * @param int    $l  长度
     * @param string $c  种子
     * @return string
     */
    public static function createRandStr($l, $c = '123456789')
    {
        $s='';
        $cl=strlen($c) - 1;
        for ($i = 0; $i < $l;  ++$i) {
            $s .= $c[ mt_rand(0, $cl) ];
        }
        return $s;
    }
}