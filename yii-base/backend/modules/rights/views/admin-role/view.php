<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminRole */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '角色管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-role-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'role_name',
            [
                'attribute' => 'is_on',
                'value'     => ($model->is_on == 1) ? '是' : '否'
            ],
            'add_time',
            'update_time:datetime',
        ],
    ]) ?>

</div>
