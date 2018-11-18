<?php

namespace backend\modules\cms;

/**
 * app module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\cms\controllers';

    /**
     * @var string
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public $name = 'cms';

    /**
     * @var string
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public $defaultRoute='index';
}
