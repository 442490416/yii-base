<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/10
 * Time: 上午11:43
 */

namespace common\assets;

use yii\web\JqueryAsset;

/**
 * Class Base64Asset
 * @package common\assets
 * User Jiang Haiqiang
 */
class Base64Asset extends Asset
{
    /**
     * @var string
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public $sourcePath = '@common/bower/base64';

    /**
     * @var array
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public $js = [
        'jquery-base64.js',
    ];

    /**
     * @var array
     * @author 姜海强 <jhq0113@163.com>
     */
    public $depends = [
        JqueryAsset::class
    ];
}