<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\upload\ImageWidget;
use common\widgets\MdEditorWidget;
use modules\cms\models\Article;

/* @var $this yii\web\View */
/* @var $model modules\cms\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'logo')->widget(ImageWidget::class,[])?>
    <p style="margin-left: 20px;font-size: 16px;color: #F32043;">* 高520*宽340px图片</p>

    <?= $form->field($model, 'type')->dropDownList(Article::$TYPE_MAP) ?>

    <?= $form->field($model, 'maintaince')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(MdEditorWidget::class,[]) ?>

    <?= $form->field($model, 'is_on')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>