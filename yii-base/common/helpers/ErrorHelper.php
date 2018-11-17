<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/9/6
 * Time: 18:11
 */

namespace common\helpers;

/**
 * Class ErrorHelper
 * @package ucf\libs\helpers
 * Author: Jiang Haiqiang
 * Email : jhq0113@163.com
 * Date: 2018/9/6
 * Time: 18:11
 */
class ErrorHelper
{
    /**
     * @var array
     * Author: Jiang Haiqiang
     * Email : jhq0113@163.com
     * Date: 2018/7/10
     * Time: 17:25
     */
    public static $SUCCESS=[
        'code'  =>  '20000',
        'msg'   =>  '操作成功'
    ];

    /**
     * @var array
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public static $ERROR_NOT_LOGIN = [
        'code' => '30001',
        'msg'  => '未登录'
    ];

    /**
     * @var array
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public static $ERROR_FORBIDDEN = [
        'code' => '30002',
        'msg'  => '权限不够'
    ];

    /**
     * @param array $config
     * @param array $data
     * @return array
     * Author: Jiang Haiqiang
     * Email : jhq0113@163.com
     * Date: 2018/7/10
     * Time: 17:27
     */
    public static function response($config,$data=[])
    {
        return array_merge($config,[
            'data'=>$data
        ]);
    }

    /**
     * @param array $data
     * @return array
     * Author: Jiang Haiqiang
     * Email : jhq0113@163.com
     * Date: 2018/7/10
     * Time: 17:28
     */
    public static function success($data=[])
    {
        return array_merge(self::$SUCCESS,[
            'data'  => $data
        ]);
    }

    /**
     * @param array $reponse
     * @return bool
     * Author: Jiang Haiqiang
     * Email : jhq0113@163.com
     * Date: 2018/8/14
     * Time: 10:52
     */
    public static function isSuccess($response)
    {
        if($response['code'] === self::$SUCCESS['code']) {
            return true;
        }
        return false;
    }
}