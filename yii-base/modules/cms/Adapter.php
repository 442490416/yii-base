<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/18
 * Time: 下午9:31
 */

namespace modules;

use modules\cms\api\Module;

/**
 * Class Adapter
 * @package modules
 * User Jiang Haiqiang
 */
class Adapter extends \modules\base\Adapter
{
    /**
     * @var array
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public $api = [
        'class' => Module::class
    ];
}