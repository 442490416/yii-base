<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <div style="text-align: center;">
        <a href="<?=Html::encode($returnUrl)?>" class="btn btn-success" style="width: 300px;">返回</a>
    </div>
</div>
