<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%admin_role}}".
 *
 * @property int $id 角色表
 * @property string $role_name 角色名称
 * @property int $is_on 是否启用(0未启用，1启用)
 * @property string $add_time 添加时间
 * @property string $update_time 更新时间
 */
class AdminRole extends \common\base\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%admin_role}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_on'], 'integer'],
            [['add_time', 'update_time'], 'safe'],
            [['role_name'], 'string', 'max' => 32],
            [['role_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '角色表'),
            'role_name' => Yii::t('app', '角色名称'),
            'is_on' => Yii::t('app', '是否启用(0未启用，1启用)'),
            'add_time' => Yii::t('app', '添加时间'),
            'update_time' => Yii::t('app', '更新时间'),
        ];
    }
}
