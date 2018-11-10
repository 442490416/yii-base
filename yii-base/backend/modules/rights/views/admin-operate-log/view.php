<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminOperateLog */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '操作日志', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-operate-log-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'admin_id',
            'admin_name',
            'router',
            'operate_desc',
            [
                'attribute' => 'operate_ip',
                'value'     => ip2long($model->operate_ip)
            ],
            'add_time',
        ],
    ]) ?>

</div>
