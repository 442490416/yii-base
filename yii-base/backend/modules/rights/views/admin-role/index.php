<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\AdminRole */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '角色管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-role-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加角色', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'role_name',
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
            'add_time',
            'update_time:datetime',
            [
                'class' => \common\base\ActionColumn::class
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
