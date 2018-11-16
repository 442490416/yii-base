<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/16
 * Time: 下午11:12
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminUser */
/* @var $form yii\widgets\ActiveForm */

$this->title = '编辑['.$model->role_name.']角色权限';
$this->params['breadcrumbs'][] = ['label' => '角色管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = '编辑角色权限';

?>

<div class="admin-user-role-set-form">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr/>

    <?php $form = ActiveForm::begin(); ?>

    <?php var_dump($rightList);?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>