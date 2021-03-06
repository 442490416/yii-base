<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/2
 * Time: 18:29
 */

namespace common\assets;


/**
 * Class MomentAsset
 * @package common\assets
 * Author: Jiang Haiqiang
 * Email : jhq0113@163.com
 * Date: 2018/11/2
 * Time: 18:29
 */
class MomentAsset extends Asset
{
    public $sourcePath = '@common/bower/moment';

    public $js = [
        'moment.js',
    ];
}