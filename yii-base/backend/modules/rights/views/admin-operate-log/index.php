<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\AdminOperateLog */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '操作日志';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-operate-log-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'admin_id',
            'admin_name',
            'router',
            'operate_desc',
            //'operate_ip',
            'add_time',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' =>'{view}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
