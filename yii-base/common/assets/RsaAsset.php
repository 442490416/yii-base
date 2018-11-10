<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/10
 * Time: 上午10:46
 */

namespace common\assets;


use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Class RsaAsset
 * @package common\assets
 * User Jiang Haiqiang
 */
class RsaAsset extends AssetBundle
{
    /**
     * @var string
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public $sourcePath = '@common/bower/rsa';

    /**
     * @var array
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public $js = [
        'jsencrypt.min.js',
    ];

    /**
     * @var array
     * @author 姜海强 <jhq0113@163.com>
     */
    public $depends = [
        JqueryAsset::class,
    ];
}