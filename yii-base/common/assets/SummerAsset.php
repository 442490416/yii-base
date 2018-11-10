<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/2
 * Time: 下午10:33
 */

namespace common\assets;

use yii\web\View;

/**
 * Class SummerAsset
 * @package common\assets
 * User Jiang Haiqiang
 */
class SummerAsset extends Asset
{
    public $sourcePath = '@common/bower/summernote/dist';

    /**
     * @var array
     * @author 姜海强 <jhq0113@163.com>
     */
    public $js = [
        'summernote.min.js',
        'jquery-summernote.js'
    ];

    /**
     * @var array
     * @author 姜海强 <jhq0113@163.com>
     */
    public $css=[
        'summernote.css'
    ];

    /**
     * @var array
     * @author 姜海强 <jhq0113@163.com>
     */
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    /**处理Summernote初始化参数并得到加载脚本
     * @param View   $view
     * @param string $id
     * @param array  $options
     * @param string $uploadUrl
     * @return string
     * @author 姜海强 <jhq0113@163.com>
     */
    public function dealOptionsAndGetScript(View $view,$id,$options,$uploadUrl)
    {
        //注册语言js
        $langJsFile = $view->getAssetManager()->getAssetUrl($this, 'lang/summernote-'.$options['lang'].'.js');
        $view->registerJsFile($langJsFile,[
            'depends'=>[
                SummerAsset::class
            ]
        ]);

        return '$(\'#' . $id .'\').summernote($.addUploadImgOption('.json_encode($options).',"'.$uploadUrl.'","'.$id.'"));';
    }
}