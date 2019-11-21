<?php

namespace backend\controllers;

use backend\controllers\common\MetaBaseController;
use common\helper\CacheHelper;

class MainController extends MetaBaseController {

    /**
    -- created_at->format('Y-m-d')；
    -- select date_sub(curdate(),interval 1 day)

    -- 昨日新增记录
    SELECT count(1) FROM metadata.meta_db_system WHERE DATE(created_at) = date_sub(curdate(),interval 1 day);
    -- 近一周新增元数据
    SELECT count(1) FROM metadata.meta_db_system WHERE DATE(created_at) > date_sub(curdate(),interval 7 day);

    -- 累计新增记录
    SELECT count(1) FROM metadata.meta_db_system;
    -- 已经废弃
    SELECT count(1) FROM metadata.meta_db_system WHERE `status`=0;

    -- 昨日操作用户数据
    SELECT author,count(1) FROM metadata.meta_db_system_record WHERE DATE(created_at) = date_sub(curdate(),interval 1 day) GROUP BY author;
    -- 近一周操作用户数据
    SELECT author,count(1) FROM metadata.meta_db_system_record WHERE DATE(created_at) > date_sub(curdate(),interval 7 day) GROUP BY author;

    -- 累计用户数
    SELECT count(1) FROM metadata.meta_admin_user;
     */
    public function actionIndex(){
        CacheHelper::destoryAllCache();
        $data = [
            'finance' => [
                'today' => 0,
                'month' => 0
            ],
            'member' => [
                'today_new' => 0,
                'month_new' => 0,
                'total' => 0
            ],
            'order' => [
                'today' => 0,
                'month' => 0
            ],
            'shared' => [
                'today' => 0,
                'month' => 0
            ]
        ];
        return $this->render('index',[
            'data' => $data
        ]);
    }

}
