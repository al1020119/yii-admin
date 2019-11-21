<?php

use \backend\models\AdminUser;
use \backend\models\DbSystem;
use \backend\models\DbSystemRecord;

?>

<div class="wrapper wrapper-content" style="margin-top: 10px; overflow: scroll">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-primary pull-right">日统计</span>
                    <h5>【昨日】新增</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?=
                        DbSystem::getYesDbSysCount();
                    ?></h1>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-primary pull-right">累计统计</span>
                    <h5>【汇总】元数据</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?= DbSystem::getDbSysCount(); ?></h1>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-primary pull-right">累计统计</span>
                    <h5> 操作日志 </h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?= DbSystemRecord::getRecordCount();?></h1>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-primary pull-right">累计统计</span>
                    <h5> 用户数</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?= AdminUser::getAdminCount();?></h1>
                    <!--<h6 class="no-margins" style="padding-top: 15px">平均操作次数：--><?//=sprintf("%.1f",$data['finance']['today']);?><!--</h6>-->
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12" id="finance" style="height: 1000px;border: 1px solid #e6e6e6;padding-top: 30px;">

        </div>
    </div>
</div>