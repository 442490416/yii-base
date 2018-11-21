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

    //--------------------------------返回数据--------------------------------------
    /**检测是否是跨域请求
     * @return bool
     * @author 姜海强
     */
    private static function checkCrossDomain()
    {
        return self::fInt('cdRoMani',$_POST) == 1;
    }

    /**得到跨域脚本
     * @return string
     * @author 姜海强
     */
    private static function getRetData($result)
    {
        return (self::checkCrossDomain()?CROSSDOMAINSCRIPT:'').json_encode($result,JSON_UNESCAPED_UNICODE);
    }

    /**返回状态信息，具体参考StateHelper
     * @param array $state         StateHelper的静态属性
     * @param mixed $addtion       附加信息
     */
    public static function retState(array $state,$addtion='')
    {
        $result = ['data'=> $state['desc'],'status' => $state['code'],'addition'=>$addtion];
        self::retArray($result);
    }

    /**通用Ajax返回信息    SUCCESS
     * @param mixed $data                DATA
     * @param mixed $status              状态码
     */
    public static function retData($data = 'SUCCESS', $status = '200')
    {
        $result=['status' => $status,'data'=> $data];
        self::retArray($result);
    }

    /**返回数据
     * @param array $data
     * @author 姜海强 <jhq0113@163.com>
     */
    public static function retArray(array $data)
    {
        \Yii::$app->response->send();
        header('Content-Type: application/json; charset=UTF-8');
        exit(self::getRetData($data));
    }

    /**
     *通用Ajax返回信息   NULL_OR_EMPTY
     */
    public static function retNullOrEmpty($data = "")
    {
        $result = ['status' => '-1','data' => $data];
        \Yii::$app->response->send();
        exit(self::getRetData($result));
    }
    //--------------------------------返回数据--------------------------------------

}