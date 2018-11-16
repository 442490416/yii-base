<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\AdminUser */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理员管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加管理员', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_name',
            'true_name',
            //'password',
            [
                'attribute' => 'is_on',
                'value'     => function($model) {
                    return ($model->is_on == 1) ? '已启用' : '已禁用';
                },
                'filter' => [
                    '0' => '已禁用',
                    '1' => '已启用'
                ]
            ],
            [
                'attribute' => 'is_super_admin',
                'value'     => function($model) {
                    return ($model->is_super_admin == 1) ? '是' : '否';
                },
                'filter'=>[
                    '0' => '否',
                    '1' => '是'
                ]
            ],
            [
                'attribute' => 'last_login_ip',
                'value'     => function($model) {
                    return long2ip($model->last_login_ip);
                },
                'filter' => false
            ],
            'add_time',
            //'update_time:datetime',
            [
                'class'    => \common\base\ActionColumn::class,
                'template' => '{view} {update} {role-set} {remove} {delete}',
                'buttons'  => [
                    'role-set' => function($url, $model, $key) {
                        $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-transfer"]);
                        return Html::a($icon, $url, ['title'=>'角色管理']);
                    }
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
