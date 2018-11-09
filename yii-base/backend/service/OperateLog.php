<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/9
 * Time: 下午10:51
 */

namespace backend\service;


use backend\models\AdminOperateLog;
use common\base\Service;
use common\helpers\ComHelper;
use common\helpers\StringHelper;
use yii\log\LogRuntimeException;

/**
 * Class OperateLog
 * @package backend\service
 * User Jiang Haiqiang
 */
class OperateLog extends Service
{
    const LOGIN = 'LOGIN';

    /**
     * @var array
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public $template = [];

    /**
     * @param string $templateId
     * @param array  $params
     * @return bool
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public function log($templateId,$params=[])
    {
        if(!isset($this->template[ $templateId ])) {
            throw new LogRuntimeException($templateId.'不存在');
        }

        $log = new AdminOperateLog();
        $log->admin_id     = \Yii::$app->login->userInfo->id;
        $log->admin_name   = \Yii::$app->login->userInfo->user_name;
        $log->router       = \Yii::$app->requestedRoute;
        $log->operate_ip   = ComHelper::getClientIp();
        $log->operate_desc = StringHelper::interpolate($this->template[ $templateId ],$params);
        return $log->save();
    }
}