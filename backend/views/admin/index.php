<?php

use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use backend\assets\AppAsset;
AppAsset::addCss($this , "/plugins/bootstrap-sweetalert/sweet-alert.css");
AppAsset::addScript($this , "/plugins/bootstrap-sweetalert/sweet-alert.min.js");
AppAsset::addScript($this , "/js/actionApp.js");
$this->title = '元数据管理系统';
?>
<div class="panel">
    <div class="panel-body">
        <?php Pjax::begin(['id' => 'item-data-list']);?>
        <div class="row">
            <div class="col-sm-6">
                <div class="m-b-30">
                    <a href="<?=Url::toRoute('/admin/create')?>" class="btn btn-primary waves-effect waves-light">
                        创建管理员
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="">
            <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                <div class="row">
                    <form class="form-horizontal" action="" method="get">
                        <div class="col-sm-9">
                            <div class="dataTables_filter">
                                <label>
                                    搜索:
                                    <input type="text" name="username" value="<?=Yii::$app->request->get('username')?>" class="form-control input-sm" placeholder="输入用户名">
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped dataTable no-footer">
                            <thead>
                            <tr role="row">
                                <th style="text-align: center;font-size: 12px" class="col-sm-1 sorting">用户名</th>
                                <th style="text-align: center;font-size: 13px" class="col-sm-2 sorting">邮箱</th>
                                <th style="text-align: center;font-size: 13px" class="col-sm-1 sorting">用户级别</th>
                                <th style="text-align: center;font-size: 13px" class="col-sm-1 sorting">状态</th>
                                <th style="text-align: center;font-size: 13px" class="col-sm-2 sorting">创建时间</th>
                                <th style="text-align: center;font-size: 13px" class="col-sm-2 sorting">最近访问</th>
                                <th style="text-align: center;font-size: 13px" class="col-sm-1 sorting">用户备注</th>
                                <th style="text-align: center;font-size: 13px" class="col-sm-2 sorting">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($data['items'] as $item):?>
                            <tr class="gradeA odd">
                                <td style="text-align: center;font-size: 13px"><?=$item->username?></td>
                                <td style="text-align: center;font-size: 13px"><?=$item->email?></td>
                                <td style="text-align: center;font-size: 13px">
                                    <?php
                                    switch($item->user_level)
                                    {
                                        case 0:echo "<a class='label label-danger'>超级管理员</a>";break;
                                        case 1:echo "<a class='label label-primary'>普通管理员</a>";break;
                                        case 2:echo "<a class='label label-warning'>[普通用户]</a>";break;
                                    }
                                    ?>
                                </td>
                                <td style="text-align: center;font-size: 13px">
                                <?php
                                switch($item->status)
                                {
                                    case 1:echo "<a onclick='actionApp.changeStatus(this);return false;' href='".Url::toRoute('/admin/switch-status?id='.$item->id)."' class='label label-primary'>启用</a>";break;
                                    case 0:echo "<a onclick='actionApp.changeStatus(this);return false;' href='".Url::toRoute('/admin/switch-status?id='.$item->id)."' class='label label-warning'>禁用</a>";break;
                                }
                                ?>
                                </td>
                                <!--TODO：-->
                                <td style="text-align: center;font-size: 13px"><?= $item->created_at //date('Y-d-m H:i:s',$item->created_at)?></td>
                                <td style="text-align: center;font-size: 13px"><?=$item->last_access?></td>
                                <td style="text-align: center;font-size: 13px"><?=$item->remarks?></td>
                                <td style="text-align: center;font-size: 13px" class="actions">
                                    <a onclick="location.href=this.href" href="<?=Url::toRoute('/admin/update?id='.$item->id)?>" class="on-default edit-row">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a onclick="location.href=this.href" href="<?=Url::toRoute('/admin/change-pwd?id='.$item->id)?>" class="on-default remove-row">
                                        <i class="fa fa-unlock-alt"></i>
                                    </a>
                                    <a onclick="actionApp.deleteDatas(this);return false;" href="<?=Url::toRoute('/admin/delete?id='.$item->id)?>" class="on-default remove-row">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="dataTables_info">
                            当前显示 <?=$data['pages']->offset+1?> - <?=$data['pages']->offset+count($data['items'])?> 共 <?=$data['pages']->totalCount?> 记录
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="dataTables_paginate paging_simple_numbers text-right">
                            <?=LinkPager::widget([
                                'pagination' => $data['pages'],
                                'prevPageLabel' => '上一页',
                                'nextPageLabel' => '下一页',
                                'firstPageLabel' => '首页',
                                'lastPageLabel' => '末页',
                            ]);?>
                        </div>
                    </div>
                    <div class="col-sm-offset-11">
                        <div class="dataTables_length">
                            <label>
                                <select class="form-control input-sm" name="pageSize">
                                    <option value="10" <?=Yii::$app->request->get('pageSize') == 10 ? 'selected' : ''?>>每页10行</option>
                                    <option value="30" <?=Yii::$app->request->get('pageSize') == 30 ? 'selected' : ''?>>每页30行</option>
                                    <option value="50" <?=Yii::$app->request->get('pageSize') == 50 ? 'selected' : ''?>>每页50行</option>
                                    <option value="100" <?=Yii::$app->request->get('pageSize') == 100 ? 'selected' : ''?>>每页100行</option>
                                </select>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php Pjax::end();?>
    </div>
</div>
