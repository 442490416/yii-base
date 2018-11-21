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
        'width'           => "98%",
        'height'          => 640,
        'syncScrolling'   => "single",
        'htmlDecode'      => "style,script,iframe",
        'emoji'           => false,
        'theme'           => "dark",
        'previewTheme'    => "dark",
        'editorTheme'     => "pastel-on-dark",
        'taskList'        => true,
        'tex'             => true,
        'flowChart'       => true,
        'sequenceDiagram' => true,
        'codeFold'        => true,
        'imageUpload'     => true,
        'imageFormats'    => ["jpg", "jpeg", "gif", "png"],
        'imageUploadURL'  => "/up/upload",
    ];

    /**
     * @var string
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    private $_editorId;

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

        $this->_editorId = $id.'-content';

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

        $attribute = $this->attribute;
        $valueHtml = Html::activeHiddenInput($this->model,$this->attribute,['id' => $this->id]);

        return $valueHtml.'<div id="'.$this->_editorId.'"><textarea style="display:none;">'.$this->model->$attribute.'</textarea></div>';

    }

    /**
     * @author 姜海强 <jhq0113@163.com>
     */
    protected function registerAsset()
    {
        MdEditorAsset::register($this->view);

        $script='var '.$this->attribute.'=editormd("'.$this->_editorId.'",'.json_encode($this->options).');$("form").on("beforeValidate",function(){$("#'.$this->id.'").val('.$this->attribute.'.getMarkdown())});';
        $this->view->registerJs($script, View::POS_READY);
    }
}