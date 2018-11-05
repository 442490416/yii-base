<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%admin_user_role}}".
 *
 * @property int $admin_id 管理员id
 * @property int $role_id 角色ID
 */
class AdminUserRole extends \common\base\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%admin_user_role}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['admin_id', 'role_id'], 'required'],
            [['admin_id', 'role_id'], 'integer'],
            [['admin_id', 'role_id'], 'unique', 'targetAttribute' => ['admin_id', 'role_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'admin_id' => Yii::t('app', '管理员id'),
            'role_id' => Yii::t('app', '角色ID'),
        ];
    }
}
