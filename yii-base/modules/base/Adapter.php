<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/18
 * Time: 下午9:47
 */

namespace modules\base;

use yii\di\Instance;

/**
 * Class Adapter
 * @package modules\base
 * User Jiang Haiqiang
 */
class Adapter
{
    /**
     * @var Api
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public $api;

    /**
     * Adapter constructor.
     * @throws \yii\base\InvalidConfigException
     */
    public function __construct()
    {
        $this->api = Instance::ensure($this->api,Api::class);
    }

    /**
     * @param $name
     * @param $arguments
     * @return static
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        return call_user_func_array([$this->api,$name],$arguments);
    }
}