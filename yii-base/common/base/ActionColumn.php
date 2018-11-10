<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/10
 * Time: 下午8:57
 */

namespace common\base;

use yii\helpers\Html;
/**
 * Class ActionColumn
 * @package common\base
 * User Jiang Haiqiang
 */
class ActionColumn extends \yii\grid\ActionColumn
{
    public $template = '{view} {update} {remove} {delete}';

    /**
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub

        $remove = [
            'remove' => function($url, $model, $key){
                if(!isset($model->is_on)) {
                    return '';
                }
                $iconName = 'ok-circle';
                $title    = '启用';
                if(($model->is_on == 1)) {
                    $iconName = 'ban-circle';
                    $title    = '禁用';
                }

                $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-$iconName"]);
                return Html::a($icon, $url, ['title'=>$title]);
            }
        ];

        $this->buttons = array_merge($this->buttons,$remove);
    }
}