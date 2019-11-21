<?php

use yii\helpers\Url;
use yii\bootstrap\Alert;
$this->title = '元数据管理系统';
$request = Yii::$app->request->post();
//键值为error的弹话框
if(Yii::$app->getSession()->hasFlash('pwd_user')){
    echo Alert::widget([
        'options'=>[
            'class'=>'error',
        ],
        'body'=>Yii::$app->getSession()->getFlash('pwd_user'),
    ]);
}
?>
<div class="row">
    <div class="col-lg-6">
        <div class="card-box">
            <h4 class="m-t-0 header-title"><b>修改密码</b></h4>

            <form class="form-horizontal" action="" method="post">
                <input type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>">
                <div class="form-group">
                    <label class="col-sm-3 control-label">用户名：</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?=$item['username']?>" placeholder="" disabled required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password_hash" class="col-sm-3 control-label">新密码：</label>
                    <div class="col-sm-8">
                        <input id="password_hash" type="password" class="form-control" name="password_hash" placeholder="" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            确认
                        </button>
                        <button type="button" onclick="location.href='<?=Url::toRoute('/admin')?>'" class="btn btn-default waves-effect waves-light m-l-5">
                            返回
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

