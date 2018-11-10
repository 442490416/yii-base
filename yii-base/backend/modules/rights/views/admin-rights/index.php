<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\AdminRights;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\AdminRights */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '权限节点管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-rights-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加权限节点', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description',
            [
                'attribute'  => 'level',
                'value'      => function($model) {
                    return AdminRights::$LEVEL_MAP[ $model->level ];
                },
                'filter'     => AdminRights::$LEVEL_MAP
            ],
            'parent_id',
            [
                'attribute' => 'is_on',
                'value'     => function($model) {
                    return ($model->is_on == 1) ? '已启用' : '已禁用';
                },
                'filter' => [
                    '0' => '已禁用',
                    '1' => '已启用'
                ]
            ],
            [
                'attribute' => 'is_show',
                'value'     => function($model) {
                    return ($model->is_show == 1) ? '是' : '否';
                },
                'filter' => [
                    '0' => '是',
                    '1' => '否'
                ]
            ],
            'range',
            [
                'class'    => \common\base\ActionColumn::class,
                'template' => '{update} {remove} {delete}'
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
