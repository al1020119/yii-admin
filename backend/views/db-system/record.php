<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\AdminUser;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DbSystemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '元数据管理系统';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="db-system-index">

    <p style="margin-top: 20px;">
        <?php
            echo Html::label("操作记录: ".$meta_id);
        ?>
    </p>
    <p style="margin-bottom: 20px">
        <?php
        $mode = \backend\models\DbSystem::findOne(['id'=>$meta_id]);
        echo Html::label(" 数据库名: ".$mode->db_name."  表名: ".$mode->table_name."  字段名: ".$mode->field_name."  字段类型: ".$mode->field_type."  字段值: ".$mode->field_value);
        ?>
    </p>

    <?= GridView::widget([
        'options' => ['style'=>'overflow:auto'],
        'options' => ['style' => 'font-size:5px;'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'created_at',
                'enableSorting' => false,
                'headerOptions' => ['style'=>'color:gray;font-size:4px;'],
            ],
            [
                'attribute' => 'author',
                'enableSorting' => false,
                'headerOptions' => ['style'=>'color:gray;font-size:4px;'],
            ],
            [
                'attribute' => 'action_type',
                'enableSorting' => false,
                'headerOptions' => ['style'=>'color:gray;font-size:4px;'],
                'value' => function($data) {
                    $actionTypes = [0=>'创建',1=>'更新',2=>'删除'];
                    return $actionTypes[$data['action_type']];
                },
            ],
            [
                'attribute' => 'action_content',
                'enableSorting' => false,
                'format'=>'raw',
                'encodeLabel' => true,
                'headerOptions' => ['style'=>'color:gray;font-size:4px;'],
                'value' => function($data) {
                    return sprintf(
                        '<a style="word-break: break-all;padding-left: 5px;padding-right: 5px">%s</a>',
                        $data->action_content
                    );
                },
            ],
        ],
    ]); ?>
</div>
