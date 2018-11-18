<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/18
 * Time: 下午10:23
 */

namespace backend\modules\cms\controllers;


use backend\controllers\Controller;

/**
 * Class IndexController
 * @package backend\modules\cms\controllers
 * User Jiang Haiqiang
 */
class IndexController extends Controller
{
    /**
     * @return string
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public function actionIndex()
    {
        return $this->render('@backend/views/site/index',[
            'title' => $this->module->name
        ]);
    }
}