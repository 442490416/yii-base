<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use backend\service\Right;

AppAsset::register($this);

$rightList = Right::self()->rightList;

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script type="text/javascript">
        var Page = {};
    </script>
</head>
<body class="nav-md">
<?php $this->beginBody() ?>

<div class="container body">

    <div class="main_container">
        <!--左面内容-->
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="/site/index" class="site_title"><i class="fa fa-paw"></i> <span><?=\Yii::$app->name?></span></a>
                </div>
                <div class="clearfix"></div>
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="/images/img.jpg" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>欢迎</span>
                        <h2><?=Html::encode(\Yii::$app->login->userName)?></h2>
                    </div>
                </div>

                <br />

                <!-- 菜单 -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <?php foreach ($rightList as $app):?>
                        <div class="menu_section">
                            <h3>模块</h3>
                            <?php foreach ($app['nodes'] as $module):?>
                                <ul class="nav side-menu">
                                    <li><a><i class="<?=$module['module_class']?>"></i><?=$module['description']?><span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <?php foreach ($module['nodes'] as $controller):?>
                                                <li><a href="/<?=$module['name'].'/'.$controller['name']?>"><?=$controller['description']?></a></li>
                                            <?php endforeach;?>
                                        </ul>
                                    </li>
                                </ul>
                            <?php endforeach;?>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>

        <!--顶部内容-->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:void(0);" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <img src="/images/img.jpg" alt="<?=Html::encode(\Yii::$app->login->userName)?>"><?=Html::encode(\Yii::$app->login->userName)?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="/site/logout"><i class="fa fa-sign-out pull-right"></i>注销</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!--右面内容-->
        <div class="right_col" role="main">
            <?= Breadcrumbs::widget([
                'homeLink'  => [
                    'label' => '首页',
                    'url'   => ['/'],
                ],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>

            <?= Alert::widget() ?>

            <div style="margin: 10px 20px;">
                <?= $content ?>
            </div>

        </div>
    </div>
</div>

<div class="modal-dialog" id="common-alert" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        </div>
    </div>
</div>

<div class="modal-dialog" id="common-confirm" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            <button type="button" class="btn btn-primary confirm">确定</button>
        </div>
    </div>
</div>
<?php $this->endBody() ?>

<script type="text/javascript">
    CURRENT_URL = 'http://'+window.location.host+'/<?=\Yii::$app->controller->module->id.'/'.\Yii::$app->controller->id?>';

    /**
     * 左侧是否为小侧栏
     */
    Page.barIsSmall = $.cache.get('barStatus');

    Page.init = function(){
        this.initEvent();
        this.initBar();

        if(typeof this.initPage == 'function') {
            this.initPage();
        }
    };

    Page.initBar = function() {
        if(Page.barIsSmall) {
            $('#menu_toggle .fa-bars').click();
        }
    };

    Page.initEvent = function () {
        $(window).on('unload',function(){
            Page.barIsSmall = $('body').hasClass('nav-sm');
            $.cache.set('barStatus',Page.barIsSmall);
        });
    };

    Page.ajax =function(data) {
        var successCallback = data.success;
        data.success = function (response) {
            if(response && response.code && response.code != '20000') {
                Page.alert(response.msg);
            }else {
                successCallback(response);
            }
        };

        $.comAjax(data);
    };

    /**
     * alert
     * @param {string} msg
     * @param {string} title
     */
    Page.alert = function (msg,title) {
        title = title ? title : '操作提示';
        var element = $('#common-alert');
        element.find('.modal-title').html(title);
        element.find('.modal-body').html(msg);
        element.modal('show');
    };

    /**
     *
     * @param {function} callback
     * @param {string}   body
     * @param {string}   title
     */
    Page.confirm = function(callback,body,title) {
        title = title ? title : '操作提示';
        var element = $('#common-confirm');
        element.find('.modal-title').html(title);
        element.find('.modal-body').html(body);

        $('#common-confirm .confirm').once('click',function () {
            callback(true);
        });

        element.modal('show');
    };

</script>
</body>
</html>
<?php $this->endPage() ?>
