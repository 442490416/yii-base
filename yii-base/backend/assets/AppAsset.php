<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
    ];

    public $depends = [
        'common\assets\FontAweSomeAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'common\assets\CustomAsset',
        'common\assets\MomentAsset',
        'common\assets\CommonAsset',
    ];
}
