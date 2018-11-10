<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AdminRights */

$this->title = 'Create Admin Rights';
$this->params['breadcrumbs'][] = ['label' => 'Admin Rights', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-rights-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
