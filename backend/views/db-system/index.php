<?php
use common\services\ConstantService;
use common\services\UrlService;
use common\services\UtilService;
use backend\models\DbSystem;
use backend\assets\AppAsset;

AppAsset::addCss($this , "/plugins/bootstrap-sweetalert/sweet-alert.css");
AppAsset::addScript($this , "/plugins/bootstrap-sweetalert/sweet-alert.min.js");
AppAsset::addScript($this , "/js/actionApp.js");

AppAsset::addScript($this , "/custom/meta_index.js");
?>

<?php echo Yii::$app->view->renderFile("@backend/views/common/tab_meta_db.php",[ 'current' => 'index' ]);?>

<div class="row">
    <div class="col-lg-12">
        <form class="form-inline wrap_search">
            <div class="row m-t p-w-m">

                <div class="form-group" style="padding-left: 10px">
                    <select id="search_db_name" onchange="select_db_name(this.options[this.options.selectedIndex].value)" name="db_name" class="form-control inline" style="width: 150px">
                        <option selected="selected">请选择数据库名</option>
                        <?php foreach(DbSystem::getMetaDbName() as $_db_info ):?>
                            <option <?php if(Yii::$app->cache->get('db_name') == $_db_info['db_name']):?> selected <?php endif;?> ><?php echo $_db_info['db_name'];?></option>
                         <?php endforeach;?>
                    </select>
                </div>

                <div class="form-group" style="padding-left: 10px">
                    <select id="search_table_name" onchange="select_table_name(this.options[this.options.selectedIndex].value)" name="table_name" class="form-control inline" style="width: 150px">
                        <option>请选择表名</option>
                        <?php foreach(DbSystem::getMetaTableName(isset($_GET['db_name'])?$_GET['db_name']:null) as $_db_info ):?>
                            <option <?php if(Yii::$app->cache->get('table_name') == $_db_info['table_name']):?> selected <?php endif;?> ><?php echo $_db_info['table_name'];?></option>
                        <?php endforeach;?>
                    </select>
                </div>

                <div class="form-group" style="padding-left: 10px">
                    <select id="search_field_name" onchange="select_field_name(this.options[this.options.selectedIndex].value)" name="field_name" class="form-control inline" style="width: 150px">
                        <option>请选择字段名</option>
                        <?php foreach(DbSystem::getMetaFieldName(isset($_GET['table_name'])?$_GET['table_name']:null) as $_db_info ):?>
                            <option <?php if(Yii::$app->cache->get('field_name') == $_db_info['field_name']):?> selected <?php endif;?> ><?php echo $_db_info['field_name'];?></option>
                        <?php endforeach;?>
                    </select>
                </div>

                <div class="form-group" style="padding-left: 10px">
                    <select id="search_status" onchange="select_status(this.options[this.options.selectedIndex].value)" name="status" class="form-control inline" style="width: 100px">
                        <option selected="selected" value="<?=ConstantService::$status_default;?>">请选择状态</option>
                        <?php foreach( $status_mapping as $_status => $_title ):?>
                            <option value="<?=$_status;?>" <?php if( $search_conditions['status']  == $_status):?> selected <?php endif;?> ><?=$_title;?></option>
                        <?php endforeach;?>
                    </select>
                </div>

                <div class="form-group" style="padding-left: 10px">
                    <div class="input-group" style="width: 300px">
                        <input type="text" name="search_field" placeholder="描述|操作人|备注" class="form-control" value="<?=$search_conditions['search_field'];?>">
                        <input type="hidden" name="p" value="<?=$search_conditions['p'];?>">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-primary search">
                                <i class="fa fa-search"></i>搜索
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-lg-12">
                    <a class="btn btn-w-m btn-outline btn-primary pull-right" href="<?=UrlService::buildWebUrl("/db-system/create");?>">
                        <i class="fa fa-plus"></i>  元数据
                    </a>
                </div>
            </div>
        </form>
        <table class="table table-bordered m-t">
            <thead>
            <tr>
                <th style="text-align: center;font-size: 12px" width="90px">数据库名</th>    <!--db_name-->
                <th style="text-align: center;font-size: 12px">表名</th>       <!--table_name-->
                <th style="text-align: center;font-size: 12px">表描述</th>     <!--table_desc-->
                <th style="text-align: center;font-size: 12px">字段名</th>     <!--field_name-->
                <th style="text-align: center;font-size: 12px">字段描述</th>    <!--field_desc-->
                <th style="text-align: center;font-size: 12px" width="80px">字段类型</th>   <!--field_type-->
                <th style="text-align: center;font-size: 12px">字段值</th>     <!--field_value-->
                <th style="text-align: center;font-size: 12px">字段值描述</th>   <!--field_value_desc-->
                <th style="text-align: center;font-size: 12px">数据源</th>      <!--comment-->
                <th style="text-align: center;font-size: 12px">字段状态</th>      <!--comment-->
                <th style="text-align: center;font-size: 12px">创建人</th>     <!--create_author-->
                <th style="text-align: center;font-size: 12px" width="140px">创建时间</th>    <!--created_at-->
                <th style="text-align: center;font-size: 12px">更新人</th>     <!--updated_author-->
                <th style="text-align: center;font-size: 12px" width="140px">更新时间</th>    <!--updated_at-->
                <th style="text-align: center;font-size: 12px">备注</th>      <!--comment-->
                <th style="text-align: center;font-size: 12px" width="60px">记录</th>    <!--操作记录-->
                <th style="text-align: center;font-size: 12px" width="120px">操作</th>      <!--操作-->
            </tr>
            </thead>
            <tbody>
            <?php if( $list ):?>
                <?php foreach( $list as $_item ):?>
                    <tr>
                        <td style="text-align: center;font-size: 13px"><?=UtilService::encode( $_item['db_name'] );?></td>
                        <td style="text-align: center;font-size: 13px"><?=UtilService::encode( $_item['table_name'] );?></td>
                        <td style="text-align: center;font-size: 13px"><?=UtilService::encode( $_item['table_desc'] );?></td>
                        <td style="text-align: center;font-size: 13px"><?=UtilService::encode( $_item['field_name'] );?></td>
                        <td style="text-align: center;font-size: 13px"><?=UtilService::encode( $_item['field_desc'] );?></td>
                        <td style="text-align: center;font-size: 13px"><?=UtilService::encode( DbSystem::getFileType($_item['field_type']) );?></td>
                        <td style="text-align: center;font-size: 13px"><?=UtilService::encode( $_item['field_value'] );?></td>
                        <td style="text-align: center;font-size: 13px"><?=UtilService::encode( $_item['field_value_desc'] );?></td>
                        <td style="text-align: center;font-size: 13px"><?=UtilService::encode( DbSystem::getDbSourceType($_item['source_type']) );?></td>
                        <td style="text-align: center;font-size: 13px"><?=UtilService::encode( DbSystem::getFileStatus($_item['status']) );?></td>
                        <td style="text-align: center;font-size: 13px"><?=UtilService::encode( $_item['created_author'] );?></td>
                        <td style="text-align: center;font-size: 13px"><?=UtilService::encode( $_item['created_at'] );?></td>
                        <td style="text-align: center;font-size: 13px"><?=UtilService::encode( $_item['updated_author'] );?></td>
                        <td style="text-align: center;font-size: 13px"><?=UtilService::encode( $_item['updated_at'] );?></td>
                        <td style="text-align: center;font-size: 13px"><?=UtilService::encode( $_item['comment'] );?></td>
                        <td>
                            <a class="m-l" href="<?=UrlService::buildWebUrl("/db-system/action-record",[ 'id' => $_item['id'] ]);?>">
                                <i class="fa fa-history fa"></i>
                            </a>
                        </td>
                        <td style="text-align: center">
                            <a href="<?=UrlService::buildWebUrl("/db-system/view",[ 'id' => $_item['id'] ] );?>">
                                <i class="fa fa-eye fa"></i>
                            </a>
                            <a class="m-l" href="<?=UrlService::buildWebUrl("/db-system/update",[ 'id' => $_item['id'] ]);?>">
                                <i class="fa fa-edit fa"></i>
                            </a>
                            <a onclick="actionApp.deleteDatas(this);return false;" class="m-l remove" href="<?=\yii\helpers\Url::toRoute('/db-system/delete?id='.$_item['id'])?>">
                                <i class="fa fa-trash fa"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach;?>
            <?php else:?>
                <tr><td style="text-align: center" colspan="17">暂无数据</td></tr>
            <?php endif;?>
            </tbody>
        </table>

        <!--分页代码已被封装到统一模板文件中-->
        <?php echo \Yii::$app->view->renderFile("@backend/views/common/pagination.php", [
            'pages' => $pages,
            'url' => '/db-system/index',
            'search_conditions' => [],
        ]); ?>
    </div>
</div>

<script>

    //$.post("get.php",{str:val},function(data){alert(data)}//以ajax方法提交，后台只需显示出这个结果，自然即可返回这个结果。或
    //window.location.href="/db-system/meta-table?db_name="+val;//此方法将以get方法转向到get.php，后台接收str变量即可。

    // 选中数据库
    function select_db_name(v){
        //清除second下拉框的所有内容
        document.getElementById("search_table_name").options.length = 0;
        document.getElementById("search_field_name").options.length = 0;
        $("#search_table_name").html("<option value=''>请选择表名</option>");
        $("#search_field_name").html("<option value=''>请选择字段名</option>");

        $.ajax({
            type: "post",
            url: "/db-system/meta-table", // type =2表示查询市
            data: {"parent_name": v, "type": "db"},
            dataType: "json",
            async:false,
            success: function(data) {
                $.each(data, function(i, item) {
                    $("#search_table_name").append("<option value='" + item + "'>" + item + "</option>");
                });
            },
            error:function (error) {
                alert(error);
            }
        });
    }

    // 选中表名
    function select_table_name(v){
        document.getElementById("search_field_name").options.length = 0;
        $("#search_field_name").html("<option value=''>请选择字段名</option>");

        $.ajax({
            type: "post",
            url: "/db-system/meta-table", // type =2表示查询市
            data: {"parent_name": v, "type": "table"},
            dataType: "json",
            async:false,
            success: function(data) {
                $.each(data, function(i, item) {
                    $("#search_field_name").append("<option value='" + item + "'>" + item + "</option>");
                });
            },
            error:function (error) {
                alert(error);
            }
        });

    }

    //选中字段名
    function select_field_name(v){
        $.ajax({
            type: "post",
            url: "/db-system/meta-table", // type =2表示查询市
            data: {"parent_name": v, "type": "field"},
            dataType: "json",
            async:false,
            success: function(data) {
                //print(data);
                // alert(data);
            },
            error:function (error) {
                // alert(error);
            }
        });
    }

    //选中字段名
    function select_status(v){
        //alert(data);
    }

</script>