<?php

/* @var $this yii\web\View */

$this->title = isset($title) ? $title : \Yii::$app->name;
?>
<div class="site-index" style="margin-top: 20%;text-align: center;">

    <div class="jumbotron">
        <h1>恭喜您！</h1>

        <p class="lead">欢迎来到<?=$this->title?>后台管理系统</p>
    </div>
</div>
