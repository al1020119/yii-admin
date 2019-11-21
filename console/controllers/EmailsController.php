<?php

namespace console\controllers;

use yii\web\Controller;

class EmailsController extends Controller {

    public $enableCsrfValidation = false;

    public function actionIndex() {
        echo "cron service runnning";
    }

    public function actionSendEmail() {
        $mail = \Yii::$app->mailer->compose();
        $mail->setTo('al10201119@163.com');
        $mail->setSubject("邮件测试");
        //$mail->setTextBody('zheshisha ');   //发布纯文字文本
        $mail->setHtmlBody("<br>Yii测试邮件处理");    //发布可以带html标签的文本
        if($mail->send())
            echo "success";
        else
            echo "failse";
        die();
    }

}
