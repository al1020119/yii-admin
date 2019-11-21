<?php

use yii\helpers\Url;
use yii\bootstrap\Alert;

$this->title = '元数据管理系统';
$request = Yii::$app->request->post();
//键值为error的弹话框
if(Yii::$app->getSession()->hasFlash('create_user')){
    echo Alert::widget([
        'options'=>[
            'class'=>'error',
        ],
        'body'=>Yii::$app->getSession()->getFlash('create_user'),
    ]);
}
?>
<div class="row">
    <div class="col-lg-6">
        <div class="card-box">
            <h4 class="m-t-0 header-title"><b>创建管理员</b></h4>

            <form class="form-horizontal" action="" method="post">
                <input type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>">
                <div class="form-group">
                    <label for="username" class="col-sm-3 control-label">用户名：</label>
                    <div class="col-sm-8">
                        <input id="username"  type="text" class="form-control" value="<?=isset($request['username']) ?$request['username']:''?>" name="username" placeholder="请输入用户名" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password_hash" class="col-sm-3 control-label">密码：</label>
                    <div class="col-sm-8">
                        <input id="password_hash" type="password" class="form-control" name="password_hash" placeholder="请输入密码" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="remarks" class="col-sm-3 control-label">用户级别：</label>
                    <div class="col-sm-8">
                        <input id="user_level" type="text" class="form-control" value="<?=isset($request['user_level']) ? $request['user_level']:'1'?>" name="user_level" placeholder="请输入用户界别" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">邮箱：</label>
                    <div class="col-sm-8">
                        <input id="email" type="text" class="form-control" value="<?=isset($request['email']) ?$request['email']:''?>" name="email" placeholder="请输入邮箱" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="remarks" class="col-sm-3 control-label">用户备注：</label>
                    <div class="col-sm-8">
                        <input id="remarks" type="text" class="form-control" value="<?=isset($request['remarks']) ?$request['remarks']:''?>" name="remarks" placeholder="请输入用户备注" required autofocus>
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

