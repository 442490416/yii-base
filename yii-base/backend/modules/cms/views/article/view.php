<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\assets\MdViewAsset;

MdViewAsset::register($this);

/* @var $this yii\web\View */
/* @var $model modules\cms\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '文章管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('编辑', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '您确认要删除该文章吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'logo',
            'type',
            'maintaince',
            'content:ntext',
            'add_time',
            'is_on',
        ],
    ]) ?>

</div>
<div id="md-view">
    <textarea style="display: none;">
        <?=$model->content?>
    </textarea>
</div>
<?php
 $script =<<<JS
    editor = editormd.markdownToHTML("md-view", {
            htmlDecode: "style,script,iframe",  // you can filter tags decode
            emoji: true,
            taskList: true,
            tex: true,  // 默认不解析
            flowChart: true,  // 默认不解析
            sequenceDiagram: true,  // 默认不解析
            codeFold: true
    });
JS;
    $this->registerJs($script,\yii\web\View::POS_READY);
?>