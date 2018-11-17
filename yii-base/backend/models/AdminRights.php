<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%admin_rights}}".
 *
 * @property int $id 改版后台权限表
 * @property string $name 名称
 * @property string $module_class module图标
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
            [['name','module_class'], 'string', 'max' => 64],
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
            'module_class' => Yii::t('app', 'module图标'),
            'description' => Yii::t('app', '菜单名称'),
            'level' => Yii::t('app', '级别'),
            'parent_id' => Yii::t('app', '父id'),
            'range' => Yii::t('app', '排序'),
            'is_on' => Yii::t('app', '是否启用'),
            'is_show' => Yii::t('app', '是否显示'),
        ];
    }

    /**
     * @param array $rightList
     * @return array
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public static function format($rightList)
    {
        if(empty($rightList)) {
            return [];
        }

        $formatRightList = [];
        $idParentIdMap   = array_column($rightList,'parent_id','id');

        foreach ($rightList as $right) {
            $right['text'] = $right['name'].'-'.self::$LEVEL_MAP[ $right['level'] ];

            if($right['level'] === self::APP){        //填充application
                $appId     = $right['id'];
                $right['nodes'] = [];
                $formatRightList[ $appId ] = $right;
            }
            elseif($right['level'] === self::MODULE) {   //填充module
                $appId = $right['parent_id'];
                $moduleId  = $right['id'];
                if(isset($formatRightList[ $appId] )) {
                    $right['nodes'] = [];
                    $formatRightList[ $appId ]['nodes'][ $moduleId ] = $right;
                }
            }elseif ($right['level'] === self::CONTROLLER) { //填充controller
                $controllerId = $right['id'];
                $moduleId     = $right['parent_id'];
                $appId        = $idParentIdMap[ $moduleId ];

                if(isset($formatRightList[ $appId ]['nodes'][ $moduleId ])) {
                    $right['nodes'] = [];
                    $formatRightList[ $appId ]['nodes'][ $moduleId ]['nodes'][ $controllerId ] = $right;
                }
            }elseif ($right['level'] === self::ACTION) { //填充action
                $actionId     = $right['id'];
                $controllerId = $right['parent_id'];
                $moduleId     = $idParentIdMap[ $controllerId ];
                $appId        = $idParentIdMap[ $moduleId ];

                if(isset($formatRightList[ $appId ]['nodes'][ $moduleId ]['nodes'][ $controllerId ])) {
                    $formatRightList[ $appId ]['nodes'][ $moduleId ]['nodes'][ $controllerId ]['nodes'][ $actionId ] = $right;
                }
            }
        }

        return $formatRightList;
    }

    /**
     * @param array $formatRightList
     * @param array $rightIds
     * @return array
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public static function formatRightList2TreeView($formatRightList,$rightIds)
    {
        $treeViewList = [];
        foreach ($formatRightList as $module) {
            //增加module选中状态
            $module['state'] = [
                'checked'   => isset($rightIds[ $module['id'] ])
            ];

            if(!isset($module['nodes'])) {
                array_push($treeViewList,$module);
                continue;
            }

            foreach ($module['nodes'] as $key => $controller) {
                //增加controller选中状态
                $module['nodes'][ $key ]['state'] =[
                    'checked'   => isset($rightIds[ $controller['id'] ])
                ];

                if(!isset($controller['nodes'])) {
                    continue;
                }
                //整理action节点
                $module['nodes'][ $key ]['nodes'] = array_values($controller['nodes']);

                //增加action选中状态
                $module['nodes'][ $key ]['nodes'] = array_map(function($value)use($rightIds){
                    $value['state'] = [
                        'checked'   => isset($rightIds[ $value['id'] ])
                    ];
                    return $value;
                },$module['nodes'][ $key ]['nodes']);
            }

            //整理controller节点
            $module['nodes'] = array_values($module['nodes']);

            array_push($treeViewList,$module);
        }

        return $treeViewList;
    }
}
