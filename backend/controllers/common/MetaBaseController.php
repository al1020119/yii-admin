<?php
namespace backend\controllers\common;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;

/*
 *基础制器页面
 */
class MetaBaseController extends Controller
{
    protected $page_size = 30;

    /**
     * 禁止未登录的用户访问
     * @param \yii\base\Action $action
     * @return bool|\yii\web\Response
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        parent::beforeAction($action);

        if(Yii::$app->user->isGuest){
            return $this->redirect(Url::toRoute('/login/login'));
        }
        if(!YII_DEBUG){
            $controller = Yii::$app->controller->id;
            $action = Yii::$app->controller->action->id;
            if(!Yii::$app->user->can($controller.'/'.$action)){
                if(Yii::$app->request->isAjax){
                    $this->ajaxReturn([
                        'state' => 0,
                        'message' => '对不起，您现在还没获此操作的权限！',
                    ]);
                }else{
                    throw new \yii\web\UnauthorizedHttpException('对不起，您现在还没获此操作的权限！');
                }
            }
        }
        return true;
    }

    /**
     * 加入提示信息
     * @param $type
     * @param $message
     */
    protected function addFlash($type,$message)
    {
        Yii::$app->session->setFlash($type, $message);
    }

    /**
     * ajax返回数据
     * @param $array
     */
    protected function ajaxReturn($array)
    {
        echo json_encode($array);
        die;
    }

    protected function geneReqId() {
        return uniqid();
    }

    public function post($key, $default = "") {
        return \Yii::$app->request->post($key, $default);
    }


    public function get($key, $default = "") {
        return \Yii::$app->request->get($key, $default);
    }


    protected function setCookie($name,$value,$expire = 0){
        $cookies = \Yii::$app->response->cookies;
        $cookies->add( new \yii\web\Cookie([
            'name' => $name,
            'value' => $value,
            'expire' => $expire
        ]));
    }

    protected  function getCookie($name,$default_val=''){
        $cookies = \Yii::$app->request->cookies;
        return $cookies->getValue($name, $default_val);
    }


    protected function removeCookie($name){
        $cookies = \Yii::$app->response->cookies;
        $cookies->remove($name);
    }

    protected function renderJSON($data=[], $msg ="ok", $code = 200)
    {
        header('Content-type: application/json');
        echo json_encode([
            "code" => $code,
            "msg"   =>  $msg,
            "data"  =>  $data,
            "req_id" =>  $this->geneReqId(),
        ]);

        return \Yii::$app->end();
    }

}
