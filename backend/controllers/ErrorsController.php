<?php
namespace backend\controllers;

use backend\controllers\common\MetaBaseController;
use yii\log\FileTarget;

class ErrorsController extends MetaBaseController
{

    public function actionError() {
        if (YII_ENV_PROD) {
            $this->layout = false;
            return $this->render('index');
        }
        $error = \Yii::$app->errorHandler->exception;
        $err_msg = '';
        if ($error) {
            // 记录错误信息到文件和数据库
            $file = $error->getFile();
            $line = $error->getLine();
            $code = $error->getCode();
            $message = $error->getMessage();

            $log = new FileTarget();
            $log->logFile = \Yii::$app->getRuntimePath()."/logs/err.log";

            $err_msg = $message."<br/>文件名: [{$file}]<br/>行号: [{$line}]<br/>错误代码: [{$code}]<br/>错误地址: [{$_SERVER['REQUEST_URI']}]<br/>请求数据: [<br/>".http_build_query($_POST)."<br/>]";
            $log->messages[] = [
                $err_msg,
                1,
                'application',
                microtime(true)
            ];
            //log->export();
            //TODO: 写到数据库
        }
        return "<div style='padding-left: 30px;padding-top: 30px'>"."错误页面<br/>错误信息：".$err_msg."</div>";
    }

}
