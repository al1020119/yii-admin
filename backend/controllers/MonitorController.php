<?php

namespace backend\controllers;

use yii\web\Controller;
use common\monitors\MySQLStructMonitor;

class MonitorController extends Controller {

    public function actionIndex(){

        // 实例化监控对象
        $mtd = new MySQLStructMonitor('47.107.162.122','metadata','root','iCocos10201119%');

        /* 默认分组模式
         * 'table' => "{tableName} {tableComment} {columns}",
         * -----------------------------------------------------
         * "tableName":"meta_admin_user",
         * "tableComment":"管理员用户表",
         * "columns": []
         * -----------------------------------------------------
         */

        /* $template_column取值说明
         * 1.null 默认取值
         *  "columns":[
         *      {
         *          "Field":"id",
         *          "Type":"int(11)",
         *          "Collation":null,
         *          "Null":"NO",
         *          "Key":"PRI",
         *          "Default":null,
         *          "Extra":"auto_increment",
         *          "Privileges":"select,insert,update,references",
         *          "Comment":"用户唯一标识"
         *      },
         *      ...
         *  ]
         * 2."{names}" 指定列类型
         *  "columns":[
         *      "id int(11) NO PRI auto_increment select,insert,update,references 用户唯一标识 NOT NULL Primary Key",
         *      "username varchar(50) utf8_unicode_ci NO UNI select,insert,update,references 管理员登录名 NOT NULL Unique Key",
         *      "user_level tinyint(1) unsigned NO 1 select,insert,update,references 用户级别,0:超级管理员,1:管理员,2:普通用户 NOT NULL ",
         *      "password_hash varchar(255) utf8_unicode_ci YES select,insert,update,references 密码哈希 ",
         *      "auth_key varchar(32) utf8_unicode_ci NO select,insert,update,references 认证密钥 NOT NULL ",
         *      "email varchar(255) utf8_unicode_ci NO select,insert,update,references 管理员邮箱 NOT NULL ",
         *      "status tinyint(1) unsigned NO 1 select,insert,update,references 管理员状态,1:可用,0:不可用 NOT NULL ",
         *      "created_at timestamp YES select,insert,update,references 创建时间 ",
         *      "updated_at timestamp YES select,insert,update,references 更新时间 ",
         *      "remarks varchar(50) utf8_unicode_ci NO select,insert,update,references 用户标识备注[名称] NOT NULL "
         *  ]
         */
        // 模板
        $template_column = null;
        //$template_column = "{field} {type} {collation} {null} {key} {default} {extra} {privileges} {comment} {nullName} {keyName}";
        // 执行
        $doc = $mtd->run($template_column);

        return json_encode($doc);
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
