<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%admin_user}}".
 *
 * @property int $id 后台用户表
 * @property string $user_name 登录用户名
 * @property string $true_name 真实姓名
 * @property string $password 登录密码
 * @property int $is_on 是否启用(0未启用，1启用)
 * @property int $is_super_admin 是否为超管(0否，1是)
 * @property string $last_login_ip 最后一次登录ip
 * @property string $add_time 注册时间
 * @property string $update_time 修改时间
 */
class AdminUser extends \common\base\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%admin_user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_on', 'is_super_admin', 'last_login_ip'], 'integer'],
            [['add_time', 'update_time'], 'safe'],
            [['user_name', 'true_name'], 'string', 'max' => 32],
            [['password'],'required'],
            [['password'],'string'],
            [['user_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '用户id'),
            'user_name' => Yii::t('app', '登录名'),
            'true_name' => Yii::t('app', '真实姓名'),
            'password' => Yii::t('app', '登录密码'),
            'is_on' => Yii::t('app', '是否启用'),
            'is_super_admin' => Yii::t('app', '是否为超管'),
            'last_login_ip' => Yii::t('app', '上次登录ip'),
            'add_time' => Yii::t('app', '注册时间'),
            'update_time' => Yii::t('app', '修改时间'),
        ];
    }
}
