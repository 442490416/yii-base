<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/2
 * Time: 18:21
 */

namespace common\assets;

/**
 * Class EChartsAsset
 * @package common\assets
 * Author: Jiang Haiqiang
 * Email : jhq0113@163.com
 * Date: 2018/11/2
 * Time: 18:22
 */
class EChartsAsset extends Asset
{
    public $sourcePath = '@common/bower/echarts/dist';

    public $js = [
        'echarts.min.js',
    ];
}