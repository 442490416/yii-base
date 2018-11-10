<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%admin_rights}}".
 *
 * @property int $id 改版后台权限表
 * @property string $name 名称
 * @property string $description 菜单名称
 * @property int $level 级别(1模块，2控制器，3操作)
 * @property int $parent_id 父id(模块的父id为0)
 * @property int $range 排序
 * @property int $is_on 是否启用(0未启用，1启用)
 * @property int $is_show 是否显示(0不显示，1显示)
 */
class AdminRights extends \common\base\ActiveRecord
{
    /**
     * application
     */
    const APP = '0';

    /**
     * module
     */
    const MODULE = '1';

    /**
     * controller
     */
    const CONTROLLER = '2';

    /**
     * action
     */
    const ACTION ='3';

    /**
     * @var array
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public static $LEVEL_MAP = [
        self::APP        => 'application',
        self::MODULE     => 'module',
        self::CONTROLLER => 'controller',
        self::ACTION     => 'action',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%admin_rights}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['level', 'parent_id', 'range', 'is_on', 'is_show'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['description'], 'string', 'max' => 32],
            [['name', 'level', 'parent_id'], 'unique', 'targetAttribute' => ['name', 'level', 'parent_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '权限'),
            'name' => Yii::t('app', '权限名称'),
            'description' => Yii::t('app', '菜单名称'),
            'level' => Yii::t('app', '级别'),
            'parent_id' => Yii::t('app', '父id'),
            'range' => Yii::t('app', '排序'),
            'is_on' => Yii::t('app', '是否启用'),
            'is_show' => Yii::t('app', '是否显示'),
        ];
    }
}
