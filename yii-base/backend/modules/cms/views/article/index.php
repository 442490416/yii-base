<?php

use yii\helpers\Html;
use yii\grid\GridView;
use modules\cms\models\Article;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\cms\models\search\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加普通文章', ['create','type' => Article::TYPE_HTML ], ['class' => 'btn btn-success']) ?>
        <?= Html::a('添加Markdown文章', ['create','type' => Article::TYPE_MARKDOWN ], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'logo',
            'type',
            'maintaince',
            //'content:ntext',
            //'add_time',
            //'is_on',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>