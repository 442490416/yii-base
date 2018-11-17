<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p style="text-align: center;font-size: 20px;">
      <span id="second" style="color: #F32043;">5</span>秒后自动返回
    </p>

    <div style="text-align: center;margin-top: 20%;">
        <a href="<?=Html::encode($returnUrl)?>" class="btn btn-success" style="width: 300px;">手动返回</a>
    </div>
    <script type="text/javascript">
        Page.initPage =function() {
            var num = 5;
            var timer = setInterval(function(){
                num--;
                $('#second').html(num);
                if(num <2) {
                    clearInterval(timer);
                    setTimeout(function(){
                        window.location.href = '<?=Html::encode($returnUrl)?>';
                    },1000);
                }
            },1000);
        };
    </script>
</div>
