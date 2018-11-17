<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/10
 * Time: 下午3:27
 */

namespace backend\service;

use backend\models\AdminAccess;
use backend\models\AdminRights;
use backend\models\AdminRole;
use backend\models\AdminUser;
use common\base\Service;

/**
 * Class Right
 * @package backend\service
 * User Jiang Haiqiang
 */
class Right extends Service
{
    /**
     * @var AdminUser
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public $userInfo;

    /**
     * @var array
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public $rightList;

    /**
     * Right constructor.
     */
    public function __construct()
    {
        $this->userInfo = \Yii::$app->login->userInfo;
        $this->_getList();
    }

    /**
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    protected function _getList()
    {
        if($this->userInfo->is_super_admin == '1') {
            $rightList = AdminRights::find()
                ->where([ 'is_on' => '1' ])
                ->orderBy([
                    'level' => SORT_ASC,
                    'range' => SORT_ASC
                ])
                ->asArray()
                ->all();
            $this->rightList = AdminRights::format($rightList);
        } else {
            $roleIds = AdminRole::find()
                ->where([
                    'admin_id' => $this->userInfo->id
                ])
                ->asArray()
                ->all();

            $roleIds = array_column($roleIds,'role_id');
            if(empty($roleIds)) {
                return;
            }

            $rightIds = AdminAccess::find()
                ->where([
                    'role_id' => $roleIds
                ])
                ->asArray()
                ->all();
            if(empty($rightIds)) {
                return;
            }

            $rightIds = array_column($rightIds,'right_id');
            $rightList = AdminRights::find()
                ->where([
                    'id' => $rightIds
                ])
                ->orderBy([
                    'level' => SORT_ASC,
                    'range' => SORT_ASC
                ])
                ->asArray()
                ->all();

            if(!empty($rightList)) {
                $this->rightList = AdminRights::format($rightList);
            }
        }
    }

    /**
     * @return bool
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public function checkAccess()
    {
        if($this->userInfo->is_super_admin == '1') {
            return true;
        }

        $route = \Yii::$app->requestedRoute;
        if($route === BACKEND_INDEX_ROUTE) {
            return true;
        }

        foreach ($this->rightList as $app) {
            foreach ($app['nodes'] as $module) {
                if($module['name'] === \Yii::$app->controller->module->id) {
                    foreach ($module['nodes'] as $controller) {
                        if($controller['name'] === \Yii::$app->controller->id) {
                            foreach ($controller['nodes'] as $action) {
                                if($action['name'] === \Yii::$app->controller->action->id) {
                                    return true;
                                }
                            }
                        }
                    }
                }
            }
        }

        return false;
    }
}