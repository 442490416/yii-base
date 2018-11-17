<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/17
 * Time: 上午9:07
 */

namespace common\assets;

/**
 * Class BootstrapTreeViewAsset
 * @package common\assets
 * User Jiang Haiqiang
 */
class BootstrapTreeViewAsset extends Asset
{
    public $sourcePath = '@common/bower/bootstrap-treeview';

    /**
     * @var array
     * Author: Jiang Haiqiang
     * Email : jhq0113@163.com
     * Date: 2018/11/2
     * Time: 18:33
     */
    public $js = [
        'bootstrap-treeview.min.js',
    ];

    /**
     * @var array
     * @author 姜海强 <jhq0113@163.com>
     */
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}