<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);

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
                    <div class="menu_section">
                        <h3>模块</h3>
                        <ul class="nav side-menu">
                            <li><a><i class="fa fa-ambulance"></i>权限<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="/rights/admin-user">管理员管理</a></li>
                                    <li><a href="/rights/admin-rights">权限节点管理</a></li>
                                    <li><a href="/rights/admin-role">角色管理</a></li>
                                    <li><a href="/rights/admin-operate-log">操作日志</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
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


<?php $this->endBody() ?>
<script type="text/javascript">
    $(document).ready(function () {
        CURRENT_URL = 'http://'+window.location.host+'/<?=\Yii::$app->requestedRoute?>';
    });
</script>
</body>
</html>
<?php $this->endPage() ?>
