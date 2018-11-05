<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%admin_operate_log}}".
 *
 * @property string $id 后台管理员操作记录表
 * @property int $admin_id 管理员ID
 * @property string $admin_name 管理员昵称
 * @property string $title 操作标题
 * @property string $router 操作路由
 * @property string $operate_desc 操作描述
 * @property int $operate_id 操作id
 * @property string $operate_ip 操作ip
 * @property string $add_time
 */
class AdminOperateLog extends \common\base\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%admin_operate_log}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['admin_id', 'operate_id', 'operate_ip'], 'integer'],
            [['add_time'], 'safe'],
            [['admin_name'], 'string', 'max' => 32],
            [['title'], 'string', 'max' => 64],
            [['router'], 'string', 'max' => 128],
            [['operate_desc'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '后台管理员操作记录表'),
            'admin_id' => Yii::t('app', '管理员ID'),
            'admin_name' => Yii::t('app', '管理员昵称'),
            'title' => Yii::t('app', '操作标题'),
            'router' => Yii::t('app', '操作路由'),
            'operate_desc' => Yii::t('app', '操作描述'),
            'operate_id' => Yii::t('app', '操作id'),
            'operate_ip' => Yii::t('app', '操作ip'),
            'add_time' => Yii::t('app', 'Add Time'),
        ];
    }
}
