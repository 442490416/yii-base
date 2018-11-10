<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminAccess */

$this->title = 'Update Admin Access: ' . $model->role_id;
$this->params['breadcrumbs'][] = ['label' => 'Admin Accesses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->role_id, 'url' => ['view', 'role_id' => $model->role_id, 'right_id' => $model->right_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="admin-access-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
