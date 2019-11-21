<?php

use yii\helpers\Url;
use backend\assets\AppAsset;
use backend\models\AdminUser;
use backend\models\DbSystem;

AppAsset::register($this);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>元数据管理系统</title>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
<div id="wrapper" style="overflow: auto">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="profile-element text-center">
                        <img alt="image" class="img-circle" src="/static/images/big_logo.png" />
                        <p class="text-muted" style="font-size: 20px;margin-top: 20px">元数据管理系统</p>
                    </div>
                    <div class="logo-element">
                        <img alt="image" class="img-circle" src="/static/images/small_logo.png" />
                    </div>
                </li>
                <li class="dashboard">
                    <a href="<?=Url::toRoute('/main/index');?>"><i class="fa fa-dashboard fa-lg"></i>
                        <span class="nav-label">仪表盘</span></a>
                </li>

                <li class="account">

                </li>
                <li class="account">
                    <?php if (AdminUser::getUserLevel() == AdminUser::ADMIN_ROOT) {
                        echo "<a href='" . Url::toRoute('/admin/index') . "'<i class='fa fa-user fa-lg'></i><span class='nav-label' style='font-size: 14px;margin-left: 5px'>     账号管理</span></a>";
                    };?>
                </li>
                <li class="brand">
                    <a href="<?=Url::toRoute('/db-system/index');?>"><i class="fa fa-cog fa-lg"></i> <span class="nav-label">元数据管理</span></a>
                </li>
                <li class="account">
                    <?php if (AdminUser::getUserLevel() == AdminUser::ADMIN_ROOT) {
                        echo "<a href='" . Url::toRoute('/services/index') . "'<i class='fa fa-server fa-lg'></i><span class='nav-label' style='font-size: 14px;margin-left: 5px'>     操作服务管理</span></a>";
                    };?>
                </li>
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg" style="background-color: #ffffff;">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="javascript:void(0);"><i class="fa fa-bars"></i> </a>

                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li class="hidden">
                        <a class="count-info" href="javascript:void(0);">
                            <i class="fa fa-bell"></i>
                            <span class="label label-primary">8</span>
                        </a>
                    </li>

                    <!--根据用户上一次登录的时间判断近期是否有数据更新-->
                    <li>
                        <?php if (count(DbSystem::getLastAccessMeta()) > 0) {
                            echo "<a href='" . Url::toRoute('/db-system/last-meta') . "'</i><span class='fa fa-bullhorn fa' style='font-size: 14px;margin-left: 5px'></span></a>";
                        };?>
                    </li>

                    <!--TODO: 移除退出登录，放到头像点击菜单中，并加入用户名标签-->

                    <li>
                        <button type="button" onclick="location.href='<?=Url::toRoute('/login/logout')?>'" class="btn btn-default waves-effect waves-light m-l-5">
                            退出登录
                        </button>
                    </li>

                    <!--<li><span class="m-r-sm text-muted welcome-message">--><?php //echo AdminUser::getUserName(); ?><!--</span></li>-->

                    <li class="dropdown user_info">
                        <a  class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);">
                            <img alt="image" class="img-circle" src="/static/images/avatar.png" />
                        </a>
                    </li>

                </ul>

            </nav>
        </div>
        <?=$content;?>

    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
