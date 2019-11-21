<?php
namespace backend\controllers;

use backend\controllers\common\MetaBaseController;
use backend\models\AdminUser;
use Yii;
use yii\helpers\Url;

/*
 * 用户登录注销操作
 */
class LoginController extends MetaBaseController
{
    public function beforeAction($action)
    {
        return true;
    }

    /**
     * 登录操作
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new AdminUser();
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $model->username = $post['username'];
            $model->password_hash = $post['password_hash'];
            $model->rememberMe = isset($post['rememberMe']) ? (bool)$post['rememberMe'] : 0;
            if ($model->login()) {
                $this->ajaxReturn([
                    'state' => 1,
                    'message' => '登录成功！'
                ]);
            }
            $this->ajaxReturn([
                'state' => 0,
                'message' => implode('',array_flatten($model->errors))
            ]);
        }
        return $this->renderPartial('login', ['model' => $model]);
    }

    /**
     * 退出登录操作
     * @return string
     */
    public function actionLogout()
    {
        $model = AdminUser::getSelfModel();
        $model->last_access = date('Y-m-d H:i:s',time()+8*60*60);
        $model->save();
        Yii::$app->user->logout();
        return $this->redirect(Url::toRoute('/login/login'));
    }

}
