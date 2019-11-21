<?php

# ---------修改自己密码---------
$this->title = '元数据管理系统';
$request = Yii::$app->request->post();
?>
<div class="row">
    <div class="col-lg-6">
        <div class="card-box">
            <h4 class="m-t-0 header-title"><b>修改密码</b></h4>

            <form class="form-horizontal" action="" method="post">
                <input type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>">
                <div class="form-group">
                    <label for="old_password" class="col-sm-3 control-label">原密码：</label>
                    <div class="col-sm-8">
                        <input id="old_password" type="password" class="form-control" name="old_password" placeholder="" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password_hash" class="col-sm-3 control-label">新密码：</label>
                    <div class="col-sm-8">
                        <input id="password_hash" type="password" class="form-control" name="password_hash" placeholder="" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm_password" class="col-sm-3 control-label">确认密码：</label>
                    <div class="col-sm-8">
                        <input id="confirm_password" type="password" class="form-control" name="confirm_password" placeholder="" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            保存更改
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

