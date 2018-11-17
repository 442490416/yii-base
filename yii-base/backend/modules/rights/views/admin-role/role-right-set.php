<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/16
 * Time: 下午11:12
 */

use yii\helpers\Html;
use yii\helpers\Url;
use common\assets\BootstrapTreeViewAsset;

BootstrapTreeViewAsset::register($this);

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

    <div class="row" style="margin: 20px;">
        <button id="btn_select_all" class="btn btn-success">全选</button>
        <button id="btn_select_none" class="btn btn-warning">清空</button>
        <button id="btn_submit" class="btn btn-danger">提交</button>
    </div>

    <div id="rightTree"></div>

    <script type="text/javascript">
        Page.initPage = function () {
            var data = <?=json_encode($treeViewList,JSON_UNESCAPED_UNICODE);?>;

            //初始化树结构
            $('#rightTree').treeview({
                color: "#428bca",
                expandIcon: 'glyphicon glyphicon-chevron-right',
                collapseIcon: 'glyphicon glyphicon-chevron-down',
                nodeIcon: 'glyphicon glyphicon-bookmark',
                levels:3,
                data: data,
                showCheckbox: true,
                showTags:true,
                onNodeChecked:function(event, data){
                    console.log(event,data);
                },
                onNodeUnchecked:function(event, data){
                    if(parseInt(data.level) < 3) {
                        if(typeof data.nodes != 'undefined' && !$.isEmptyObject(data.nodes)) {
                            $.each(data.nodes,function(index,item) {
                                $('#rightTree').treeview('uncheckNode', [ item.id, { silent: true } ]);
                            });
                        }
                    }else {

                    }
                }
            });

            $('#btn_select_all').on('click',function () {
                $('#rightTree').treeview('checkAll');
            });

            $('#btn_select_none').on('click',function () {
                $('#rightTree').treeview('uncheckAll');
            });

            $('#btn_submit').on('click',function () {
                var checkedList = $('#rightTree').treeview('getChecked');
                var ids = [];
                $.each(checkedList,function(index,item){
                    ids.push(item['id']);
                });

                $.comAjax({
                    url     :   '<?=Url::toRoute(['role-right-set'])?>?id=<?=$model->id?>',
                    data    :   { ids : ids },
                    success :   function (result) {
                        window.location.reload();
                    }
                });
            });
        }
    </script>
</div>