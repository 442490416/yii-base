<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/19
 * Time: 14:10
 */

namespace common\assets;

/**
 * Class MdViewAsset
 * @package common\assets
 * Author: Jiang Haiqiang
 * Email : jhq0113@163.com
 * Date: 2018/11/19
 * Time: 14:10
 */
class MdViewAsset extends Asset
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
        'lib/marked.min.js',
        'lib/prettify.min.js',
        'lib/raphael.min.js',
        'lib/underscore.min.js',
        'lib/sequence-diagram.min.js',
        'lib/flowchart.min.js',
        'lib/jquery.flowchart.min.js',
    ];

    /**
     * @var array
     * @author 姜海强 <jhq0113@163.com>
     */
    public $depends = [
        MdEditorAsset::class
    ];
}