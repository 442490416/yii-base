<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%login_log}}".
 *
 * @property string $id 登录日志
 * @property int $user_id 用户ID
 * @property string $ip 登录ip
 * @property string $time 登录时间
 * @property int $type 登录方式(0网站，1微信，2QQ，3新浪微博)
 */
class LoginLog extends \common\base\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%login_log}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'ip', 'type'], 'integer'],
            [['time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '登录日志'),
            'user_id' => Yii::t('app', '用户ID'),
            'ip' => Yii::t('app', '登录ip'),
            'time' => Yii::t('app', '登录时间'),
            'type' => Yii::t('app', '登录方式(0网站，1微信，2QQ，3新浪微博)'),
        ];
    }
}
