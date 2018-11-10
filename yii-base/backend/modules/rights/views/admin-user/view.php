<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminUser */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '管理员管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_name',
            'true_name',
            [
                'attribute'  => 'password',
                'value'      => '*********'
            ],
            [
                'attribute' => 'is_on',
                'value'     => ($model->is_on == 1) ? '是' : '否'
            ],
            [
                'attribute' => 'is_super_admin',
                'value'     => ($model->is_super_admin == 1) ? '是' : '否'
            ],
            [
                'attribute' => 'last_login_ip',
                'value'     => long2ip($model->last_login_ip)
            ],
            'add_time',
            'update_time:datetime',
        ],
    ]) ?>

</div>
