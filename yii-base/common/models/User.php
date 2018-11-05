<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property string $id 用户表
 * @property string $name 用户名
 * @property string $head_img 头像
 * @property string $password 密码
 * @property string $addition 密码项
 * @property int $mobile 手机号
 * @property int $sex 性别（1男，2女）
 * @property int $add_type 注册类型(0网站，1微信，2QQ，3新浪微博)
 * @property string $wx_open_id 微信open_id
 * @property string $qq_open_id QQ open_id
 * @property string $sina_open_id 新浪微博open_id
 * @property string $wx_public_open_id 微信公众平台open_id
 * @property string $add_ip 注册ip
 * @property string $add_time 注册时间
 * @property string $last_login_ip 上次登录ip地址
 * @property string $last_login_time 上次登录时间
 */
class User extends \common\base\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mobile', 'sex', 'add_type', 'add_ip', 'last_login_ip'], 'integer'],
            [['add_time', 'last_login_time'], 'safe'],
            [['name', 'password'], 'string', 'max' => 32],
            [['head_img'], 'string', 'max' => 255],
            [['addition', 'wx_open_id', 'qq_open_id', 'sina_open_id', 'wx_public_open_id'], 'string', 'max' => 64],
            [['mobile'], 'unique'],
            [['wx_open_id'], 'unique'],
            [['qq_open_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '用户表'),
            'name' => Yii::t('app', '用户名'),
            'head_img' => Yii::t('app', '头像'),
            'password' => Yii::t('app', '密码'),
            'addition' => Yii::t('app', '密码项'),
            'mobile' => Yii::t('app', '手机号'),
            'sex' => Yii::t('app', '性别（1男，2女）'),
            'add_type' => Yii::t('app', '注册类型(0网站，1微信，2QQ，3新浪微博)'),
            'wx_open_id' => Yii::t('app', '微信open_id'),
            'qq_open_id' => Yii::t('app', 'QQ open_id'),
            'sina_open_id' => Yii::t('app', '新浪微博open_id'),
            'wx_public_open_id' => Yii::t('app', '微信公众平台open_id'),
            'add_ip' => Yii::t('app', '注册ip'),
            'add_time' => Yii::t('app', '注册时间'),
            'last_login_ip' => Yii::t('app', '上次登录ip地址'),
            'last_login_time' => Yii::t('app', '上次登录时间'),
        ];
    }
}
