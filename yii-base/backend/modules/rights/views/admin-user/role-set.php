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

$this->title = '编辑管理员角色';
$this->params['breadcrumbs'][] = ['label' => '管理员管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = '编辑管理员角色';

?>

<div class="admin-user-role-set-form">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr/>

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::checkboxList('user-roles',$hasRoleIds,$roleList,[
        'id' => 'user-roles'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>