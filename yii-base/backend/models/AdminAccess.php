<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%admin_access}}".
 *
 * @property int $role_id 角色id
 * @property int $right_id 权限id
 */
class AdminAccess extends \common\base\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%admin_access}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_id', 'right_id'], 'required'],
            [['role_id', 'right_id'], 'integer'],
            [['role_id', 'right_id'], 'unique', 'targetAttribute' => ['role_id', 'right_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'role_id' => Yii::t('app', '角色id'),
            'right_id' => Yii::t('app', '权限id'),
        ];
    }
}
