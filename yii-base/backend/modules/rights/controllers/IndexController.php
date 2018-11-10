<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/10
 * Time: 下午3:14
 */

namespace backend\modules\rights\controllers;


use backend\controllers\Controller;

/**
 * Class IndexController
 * @package backend\modules\rights\controllers
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