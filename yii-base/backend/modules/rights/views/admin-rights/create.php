<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AdminRights */

$this->title = '添加权限节点';
$this->params['breadcrumbs'][] = ['label' => '权限节点管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-rights-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'list'  => $list
    ]) ?>

</div>
