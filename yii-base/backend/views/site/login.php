<?php

use yii\helpers\Html;
use backend\assets\AppAsset;
use yii\bootstrap\ActiveForm;
use common\assets\RsaAsset;

AppAsset::register($this);

RsaAsset::register($this);

/* @var $this  \yii\web\View */
/* @var $model \backend\models\AdminUser */
/* @var $content string */

$this->title = \Yii::$app->name.'后台系统';
$this->params['breadcrumbs'][] = $this->title;
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
<div style="margin: 15% auto;text-align: center;">
    <div class="x_panel" style="width: 30%;">
        <div class="x_title">
            <h2><?=\Yii::$app->name?> <small>后台系统</small></h2>
            <div class="clearfix"></div>
        </div>
        <?php $form = ActiveForm::begin([
                'id'        => 'login-form',
                'action'    => '/site/login',
                'class'     => 'form-horizontal form-label-left input_mask'
        ]); ?>
            <div class="x_content">
                <br>
                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                    <input type="text" class="form-control has-feedback-left" id="user_name" name="user_name" placeholder="登录名" value="<?=Html::encode(\Yii::$app->login->userName)?>">
                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                    <input type="password" class="form-control has-feedback-left" id="password" name="password" autocomplete="false" placeholder="密码">
                    <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                    <?=\yii\captcha\Captcha::widget([
                        'name'=>'captcha',
                        'captchaAction'=>'/site/captcha',
                        'imageOptions'=>[
                            'id'=>'captchaimg',
                            'title'=>'换一个',
                            'alt'=>'换一个',
                            'style'=>'cursor:pointer;'
                        ],
                        'template'=>'{image}'
                    ])?>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="captcha" name="captcha" placeholder="验证码">
                        <span class="fa fa-qrcode form-control-feedback left" aria-hidden="true"></span>
                </div>
            </div>
            <div class="x_content">
                <div class="row">
                    <p style="color: red">
                        <?=Html::encode($war)?>
                    </p>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success">登录</button>
                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php $this->endBody() ?>
<script type="text/javascript">
    $(document).ready(function(){
        var publicKey = '<?=\Yii::$app->mcrypt->publicKey?>';
        var mcrypter = new JSEncrypt();
        mcrypter.setPublicKey(publicKey);

        $('#captcha').on('keydown',function(e) {
            if (e.keyCode == 13) {
                $('#login-form').submit();
            }
        });

        $('#login-form').on('beforeValidate',function(){
            var password = $('#password').val();
            password = mcrypter.encrypt(password);
            console.log(password.urlEncode4Base64());
            $('#password').val(password);
        });
    });
</script>
</body>
</html>
<?php $this->endPage() ?>
