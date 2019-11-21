<?php

namespace backend\controllers;

use backend\controllers\common\MetaBaseController;
use backend\models\AdminUser;
use Yii;
use yii\bootstrap\Alert;
use yii\helpers\Url;

/*
 * 管理员信息与操作
 */
class AdminController extends MetaBaseController
{
    /**
     * 禁止未登录的用户访问
     * @param \yii\base\Action $action
     * @return bool|\yii\web\Response
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        if(Yii::$app->user->isGuest){
            $this->redirect(Url::toRoute('/login/login'));
            return false;
        }

        if (AdminUser::getUserLevel() != AdminUser::ADMIN_ROOT) {
            $this->goHome();
            return false;
        }

        return true;
    }

    /**
     * 管理员列表
     * @return string
     */
    public function actionIndex()
    {
        $model = new AdminUser();
        $data = $model->getAdmins(Yii::$app->request->get());
        return $this->render('index',compact('data'));
    }

    /**
     * 创建管理员
     * @return string
     */
    public function actionCreate()
    {
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();

            $tipString = '';
            $username_length = strlen($post['username']);
            $password_hash_length = strlen($post['password_hash']);
            $user_level = $post['user_level'];
            $email_str = $post['email'];
            if ($username_length > 255 || $username_length <= 2) {
                $tipString = '请输入正确的用户名';
            } else if ($password_hash_length < 5) {
                $tipString = '密码长度不能小于6';
            } else if (!is_numeric($user_level) || !in_array($user_level,['0','1','1'])) {
                $tipString = '请输入可靠的用户级别[0-1-2]';
            } else if (!filter_var($email_str, FILTER_VALIDATE_EMAIL)) {
                $tipString = '请输入正确的邮箱';
            }
            if (strlen($tipString) > 0) {
                Yii::$app->getSession()->setFlash('create_user', $tipString);
            }

            $model = new AdminUser();
            $model->username = $post['username'];
            $model->password_hash = $post['password_hash'];
            $model->user_level = $post['user_level'];
            $model->email = $post['email'];
            $model->remarks = $post['remarks'];
            $model->last_access = date('Y-m-d H:i:s',time()+8*60*60);
            if ($model->validate()) {
                $model->setPassword($post['password_hash']);
                $model->generateAuthKey();
                if($model->save()){
                    $this->redirect(Url::toRoute('/admin/index'));
                    return false;
                }
            }
            Yii::$app->getSession()->setFlash('create_user', implode('',array_flatten($model->getErrors())));
        }
        return $this->render('create');
    }

    /**
     * 管理员编辑
     * @return string
     */
    public function actionUpdate()
    {
        $id = Yii::$app->request->get('id');
        $model = new AdminUser();
        if($item = $model->find()->where(['id' => $id])->one()){
            if(Yii::$app->request->isPost){
                $post = Yii::$app->request->post();
                $item->email = $post['email'];
                $item->user_level = $post['user_level'];
                $item->remarks = $post['remarks'];
                $item->last_access = date('Y-m-d H:i:s',time()+8*60*60);
                if ($item->validate()) {
                    if($item->save()){
                        $this->redirect(Url::toRoute('/admin/index'));
                        return false;
                    }
                }
                Yii::$app->getSession()->setFlash('edit_user', implode('',array_flatten($model->getErrors())));
            }
            return $this->render('edit',compact('item'));
        } else{
            return $this->actionIndex();
        }
    }

    /**
     * 管理员删除
     * @throws \Exception
     */
    public function actionDelete()
    {
        $id = Yii::$app->request->get('id');
        $model = new AdminUser();
        if($item = $model->find()->where(['id' => $id])->one()){
            //$transaction = Yii::$app->db->beginTransaction();
            if($item->delete()){
                //$transaction->commit();
                $this->ajaxReturn([
                    'state' => 1,
                    'message' => '删除成功！',
                ]);
            }
            //$transaction->rollBack();
            $this->ajaxReturn([
                'state' => 0,
                'message' => '删除失败！'.implode('',array_flatten($item->getErrors())),
            ]);
        }else{
            $this->ajaxReturn([
                'state' => 0,
                'message' => '数据不存在！',
            ]);
        }
    }

    /**
     * 修改管理员密码
     * @return string
     */
    public function actionChangePwd()
    {
        $id = Yii::$app->request->get('id');
        $model = new AdminUser();
        if($item = $model->find()->where(['id' => $id])->one()){
            if(Yii::$app->request->isPost){
                $post = Yii::$app->request->post();
                $item->password_hash = $post['password_hash'];
                $item->last_access = date('Y-m-d H:i:s',time()+8*60*60);
                if ($item->validate()) {
                    $item->setPassword($post['password_hash']);
                    if($item->save()){
                        $this->redirect(Url::toRoute('/admin/index'));
                        return false;
                    }
                }
                Yii::$app->getSession()->setFlash('pwd_user', implode('',array_flatten($model->getErrors())));
            }
            return $this->render('pwd',compact('item'));
        }else{
            return $this->actionIndex();
        }
    }

    /**
     * 切换管理员状态
     */
    public function actionSwitchStatus()
    {
        $id = Yii::$app->request->get('id');
        $model = new AdminUser();
        if($item = $model->find()->where(['id' => $id])->one()){
            $item->status = $item->status == 1 ? 0 : 1;
            $item->last_access = date('Y-m-d H:i:s',time()+8*60*60);
            if($item->save()){
                $this->ajaxReturn([
                    'state' => 1,
                    'message' => '切换成功！',
                ]);
            }
            $this->ajaxReturn([
                'state' => 0,
                'message' => '切换失败！'.implode('',array_flatten($item->getErrors())),
            ]);
        }else{
            $this->ajaxReturn([
                'state' => 0,
                'message' => '数据不存在！',
            ]);
        }
    }

}
