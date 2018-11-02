<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/2
 * Time: 18:35
 */

namespace common\assets;

use yii\web\AssetBundle;

/**
 * Class CommonAsset
 * @package common\assets
 * Author: Jiang Haiqiang
 * Email : jhq0113@163.com
 * Date: 2018/11/2
 * Time: 18:35
 */
class CommonAsset extends AssetBundle
{
    public $sourcePath = '@common/bower/common';

    /**
     * @var array
     * Author: Jiang Haiqiang
     * Email : jhq0113@163.com
     * Date: 2018/11/2
     * Time: 18:33
     */
    public $css = [
        'css/common.css'
    ];

    /**
     * @var array
     * Author: Jiang Haiqiang
     * Email : jhq0113@163.com
     * Date: 2018/11/2
     * Time: 18:33
     */
    public $js = [
        'js/common.js',
    ];
}