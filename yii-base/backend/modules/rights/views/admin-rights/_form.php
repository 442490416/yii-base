<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\AdminRights;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminRights */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-rights-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'level')->dropDownList(AdminRights::$LEVEL_MAP) ?>

    <?= $form->field($model, 'parent_id')->dropDownList([]) ?>

    <?= $form->field($model, 'range')->textInput() ?>

    <?= $form->field($model, 'is_on')->checkbox() ?>

    <?= $form->field($model, 'is_show')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<script type="text/javascript">
    Page = {};

    Page.init = function() {
        $('#adminrights-level').on('change',function(){
            var value = $(this).val();
        });
    }
</script>