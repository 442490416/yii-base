<?php

namespace backend\modules\rights;

/**
 * app module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\rights\controllers';

    public $defaultRoute='index';
}
