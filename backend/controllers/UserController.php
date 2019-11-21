<?php

namespace backend\controllers;

use backend\controllers\common\MetaBaseController;
use Yii;

/*
 * 管理员账户信息
 */
class UserController extends MetaBaseController
{
    /**
     * 修改个人密码
     * @return string
     */
    public function actionChangePwd()
    {
        $user = Yii::$app->user->getIdentity();

        if (Yii::$app->request->isPost) {

            $post = Yii::$app->request->post();

            if (!$user->validatePassword($post['old_password'])) {
                $this->addFlash('error', '原密码错误！');
                goto render;
            }

            $user->password_hash = $post['password_hash'];

            if (!$user->validate()) {
                $this->addFlash('error', implode('', array_flatten($user->getErrors())));
                goto render;
            }

            if ($post['password_hash'] <> $post['confirm_password']) {
                $this->addFlash('error', '确认密码不一致！');
                goto render;
            }

            $user->setPassword($post['password_hash']);

            if ($user->save()) {
                $this->addFlash('success', '恭喜你，密码修改成功！');
                $this->goHome();
                goto render;
            }

            $this->addFlash('error', '密码修改失败！');
        }

        render:
        return $this->render('pwd');
    }

}
