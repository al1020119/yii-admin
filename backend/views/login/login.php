<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '元数据管理系统';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/static/images/small_logo.png">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="/static/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/static/css/core.css" rel="stylesheet" type="text/css">
    <link href="/static/css/icons.css" rel="stylesheet" type="text/css">
    <link href="/static/css/components.css" rel="stylesheet" type="text/css">
    <link href="/static/css/pages.css" rel="stylesheet" type="text/css">
    <link href="/static/css/menu.css" rel="stylesheet" type="text/css">
    <link href="/static/css/responsive.css" rel="stylesheet" type="text/css">
    <script src="/static/js/modernizr.min.js"></script>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrapper-page">
    <div class="text-center">
        <a href="" class="logo logo-lg">
            <i class="md md-desktop-mac"></i>
            <span>元数据管理系统</span>
        </a>
    </div>

    <form id="login-form" class="form-horizontal m-t-20" action="" method="post">
        <input type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>">
        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" name="username" value="" type="text" required="" autofocus placeholder="用户名">
                <i class="md md-account-circle form-control-feedback l-h-34"></i>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" name="password_hash" value="" type="password" required="" placeholder="密码">
                <i class="md md-vpn-key form-control-feedback l-h-34"></i>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-signup" name="rememberMe" type="checkbox">
                    <label for="checkbox-signup">
                        记住我
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group m-t-20">
            <div class="col-xs-12">
                <button class="btn btn-primary btn-custom w-md waves-effect waves-light col-xs-12 col-sm-12" type="submit">
                    登录
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    var resizefunc = [];
</script>
<!-- Main  -->
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/jquery.core.js"></script>
<script src="/static/plugins/notifyjs/dist/notify.min.js"></script>
<script src="/static/plugins/notifications/notify-metro.js"></script>
<script type="text/javascript">
$(function(){
    $('#login-form').submit(function(){
        $.ajax({
            type:'post',
            url:'<?=Url::toRoute('/login/login')?>',
            data:$(this).serialize(),
            dataType:'json',
            success:function(data){
                if(data.state){
                    $.Notification.autoHideNotify('success', 'top right', '提示信息',data.message);
                    location.href = '/';
                }else{
                    $.Notification.autoHideNotify('error', 'top right', '提示信息',data.message);
                }
            },
            error:function(err){
                console.log(err);
                throw err;
            }
        });
        return false;
    });
});
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
