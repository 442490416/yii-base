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

    <?= $form->field($model, 'level')->dropDownList(AdminRights::$LEVEL_MAP) ?>

    <?= $form->field($model, 'parent_id')->dropDownList([]) ?>

    <?= $form->field($model, 'name')->textInput(['placeHolder' => '[app,module,controller,action]名称，限英文']) ?>

    <?= $form->field($model, 'description')->textInput(['placeHolder' => '菜单显示名称，推荐中文']) ?>

    <?= $form->field($model, 'range')->textInput() ?>

    <?= $form->field($model, 'is_on')->checkbox() ?>

    <?= $form->field($model, 'is_show')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<script type="text/javascript">
    Page = {
        list:<?=json_encode($list,JSON_UNESCAPED_UNICODE)?>
    };

    Page.init = function() {
        $('#adminrights-level').on('change',function(){
            var level = parseInt($(this).val());
            $('#adminrights-parent_id').empty();
            if(level == 0) {
                $('#adminrights-parent_id').append('<option value="0">root</option>');
                return;
            }

            var parentLevel = level - 1;

            $.each(Page.list,function(index,item){
                if(parseInt(item.level) == parentLevel) {
                    $('#adminrights-parent_id').append('<option value="'+item.id+'">'+item.description+'</option>');
                }
            })
        });
    }
</script>