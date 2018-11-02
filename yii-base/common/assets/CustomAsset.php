<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/2
 * Time: 18:31
 */

namespace common\assets;


use yii\web\AssetBundle;

/**
 * Class CustomAsset
 * @package common\assets
 * Author: Jiang Haiqiang
 * Email : jhq0113@163.com
 * Date: 2018/11/2
 * Time: 18:31
 */
class CustomAsset extends AssetBundle
{
    public $sourcePath = '@common/bower/custom';

    /**
     * @var array
     * Author: Jiang Haiqiang
     * Email : jhq0113@163.com
     * Date: 2018/11/2
     * Time: 18:33
     */
    public $css = [
        'css/custom.min.css'
    ];

    /**
     * @var array
     * Author: Jiang Haiqiang
     * Email : jhq0113@163.com
     * Date: 2018/11/2
     * Time: 18:33
     */
    public $js = [
        'js/custom.min.js',
    ];


}