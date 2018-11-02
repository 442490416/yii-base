<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/2
 * Time: 下午11:18
 */

namespace common\assets;

use yii\web\View;
use yii\web\AssetBundle;

/**
 * Class BootstrapDatetimePickerAsset
 * @package common\assets
 * User Jiang Haiqiang
 */
class BootstrapDatetimePickerAsset extends AssetBundle
{
    public $sourcePath = '@common/bower/bootstrap-datetimepicker/dist';

    /**
     * @var array
     * Author: Jiang Haiqiang
     * Email : jhq0113@163.com
     * Date: 2018/11/2
     * Time: 18:33
     */
    public $css = [
        'css/bootstrap-datetimepicker.min.css',
    ];

    /**
     * @var array
     * Author: Jiang Haiqiang
     * Email : jhq0113@163.com
     * Date: 2018/11/2
     * Time: 18:33
     */
    public $js = [
        'bootstrap-datetimepicker.min.js',
    ];

    /**
     * @var array
     * @author 姜海强 <jhq0113@163.com>
     */
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    /**处理datetimePicker初始化参数并得到加载脚本
     * @param View   $view
     * @param string $id
     * @param array  $options
     * @return string
     * @author 姜海强 <jhq0113@163.com>
     */
    public function dealOptionsAndGetScript(View $view,$id,$options)
    {
        //注册语言js
        $langJsFile = $view->getAssetManager()->getAssetUrl($this, 'locales/bootstrap-datetimepicker.'.$options['language'].'.js');
        $view->registerJsFile($langJsFile,[
            'depends'=>[
                BootstrapDatetimePickerAsset::class
            ]
        ]);

        return '$(\'#' . $id .'\').datetimepicker('.json_encode($options).');';
    }
}