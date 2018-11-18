<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/18
 * Time: 下午8:22
 */

namespace common\widgets;

use common\assets\MdEditorAsset;
use yii\bootstrap\Html;
use yii\widgets\InputWidget;
use yii\web\View;

/**
 * Class SimpleMdeWidget
 * @package common\widgets\simplemde
 * User Jiang Haiqiang
 */
class MdEditorWidget extends InputWidget
{
    /**配置
     * @var array
     * @author 姜海强 <jhq0113@163.com>
     */
    public $options=[];

    /**默认日期格式
     * @var array
     * @author 姜海强 <jhq0113@163.com>
     */
    private $_defaultOptions=[
        'path'            => '/mdeditor/lib/',
        'width'           => "90%",
        'height'          => 640,
        'syncScrolling'   => "single",
    ];

    /**
     * @throws \yii\base\InvalidConfigException
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        //编辑器id
        $id = isset($this->options['id']) ? $this->options['id'] : Html::getInputId($this->model, $this->attribute);

        $this->setId($id);

        $this->options = array_merge($this->_defaultOptions,$this->options);
    }

    /**
     * @return string
     * @author 姜海强 <jhq0113@163.com>
     */
    public function run()
    {
        parent::run(); // TODO: Change the autogenerated stub

        $this->registerAsset();

        return Html::tag('div','',['id' => $this->id]);

    }

    /**
     * @author 姜海强 <jhq0113@163.com>
     */
    protected function registerAsset()
    {
        MdEditorAsset::register($this->view);

        $script='editormd("'.$this->id.'",'.json_encode($this->options).');';
        $this->view->registerJs($script, View::POS_READY);
    }
}