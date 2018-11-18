<?php

namespace modules\cms\models;

use Yii;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property string $id
 * @property string $title 标题
 * @property string $logo logo
 * @property int $type 类型(0html ,1markdown)
 * @property string $maintaince 摘要
 * @property string $content 内容
 * @property string $add_time 添加时间
 * @property int $is_on 是否启用
 */
class Article extends \modules\cms\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%article}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'is_on'], 'integer'],
            [['content'], 'string'],
            [['add_time'], 'safe'],
            [['title', 'logo'], 'string', 'max' => 255],
            [['maintaince'], 'string', 'max' => 511],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '文章id',
            'title' => '文章标题',
            'logo' => 'logo',
            'type' => '类型',
            'maintaince' => '摘要',
            'content' => '内容',
            'add_time' => '添加时间',
            'is_on' => '是否启用',
        ];
    }
}