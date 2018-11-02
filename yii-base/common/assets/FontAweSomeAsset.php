<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/2
 * Time: 18:25
 */

namespace common\assets;


use yii\web\AssetBundle;

/**
 * Class FontAweSomeAsset
 * @package common\assets
 * Author: Jiang Haiqiang
 * Email : jhq0113@163.com
 * Date: 2018/11/2
 * Time: 18:26
 */
class FontAweSomeAsset extends AssetBundle
{
    public $sourcePath = '@common/bower/font-awesome';

    public $css = [
        'css/font-awesome.min.css',
    ];
}