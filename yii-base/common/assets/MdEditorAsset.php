<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/18
 * Time: 下午8:20
 */

namespace common\assets;

use yii\web\JqueryAsset;

/**
 * Class SimpleMdeAsset
 * @package common\assets
 * User Jiang Haiqiang
 */
class MdEditorAsset extends Asset
{
    /**
     * @var string
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public $sourcePath = '@common/bower/mdeditor';

    /**
     * @var array
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public $js = [
        'js/editormd.min.js',
    ];

    /**
     * @var array
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public $css = [
        'css/editormd.min.css',
    ];

    /**
     * @var array
     * @author 姜海强 <jhq0113@163.com>
     */
    public $depends = [
        JqueryAsset::class
    ];
}