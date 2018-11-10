<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\AdminRights;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminRights */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
    .icon-select{
        color: #F32043;
    }
</style>

<div class="admin-rights-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'level')->dropDownList(AdminRights::$LEVEL_MAP) ?>

    <?= $form->field($model, 'parent_id')->dropDownList([]) ?>

    <?= $form->field($model, 'name')->textInput(['placeHolder' => '[app,module,controller,action]名称，限英文']) ?>

    <?= $form->field($model, 'description')->textInput(['placeHolder' => '菜单显示名称，推荐中文']) ?>

    <?= $form->field($model, 'module_class')->hiddenInput() ?>
    <p id="icon_show" class="<?=$model->module_class?> fa-2x" style="margin: 5px;"></p>
    <p class="btn btn-success" id="btn_select_icon">选择图标</p>

    <?= $form->field($model, 'range')->textInput() ?>

    <?= $form->field($model, 'is_on')->checkbox() ?>

    <?= $form->field($model, 'is_show')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<div class="modal fade" id="select_icon" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">选择图标</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <?= $this->render('_icon') ?>
                </div>
            </div>
            <div class="modal-footer text-center" style="text-align: center;">
                <button type="button" id="btn_ok" class="btn btn-success">确定</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    Page = {
        list:<?=json_encode($list,JSON_UNESCAPED_UNICODE)?>,
        model:<?=$model->isNewRecord ? json_encode((object)[]) : json_encode(['level'=>$model->level,'parent_id'=>$model->parent_id],JSON_UNESCAPED_UNICODE)?>
    };

    Page.changeLevel =function(level) {
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
    };

    Page.init = function() {
        //初始化父节点
        if($.isEmptyObject(Page.model)) {
            var level = parseInt(Page.model.level);
            Page.changeLevel(level);
            $('#adminrights-parent_id').val(Page.model.parent_id);
        }

        $('#adminrights-level').on('change',function(){
            var level = parseInt($(this).val());
            Page.changeLevel(level);
        });

        var icon = '<?=$model->module_class?>';
        $('#btn_select_icon').on('click',function () {
            $('#select_icon').modal('show');
        });

        $('.modal-body .row .fa').on('click',function () {
            $('.modal-body .row .fa').removeClass('icon-select');
            icon = $(this).attr('class');
            $(this).addClass('icon-select');
        });

        $('#btn_ok').on('click',function(){
            $('#adminrights-module_class').val(icon);
            $('#icon_show').attr('class',icon+' fa-2x');
            $('#select_icon').modal('hide');
        });
    }
</script>