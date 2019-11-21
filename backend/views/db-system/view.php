<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\DbSystem;

/* @var $this yii\web\View */
/* @var $model backend\models\DbSystem */

$this->title = '元数据管理系统';
$this->params['breadcrumbs'][] = ['label' => '元数据管理系统', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="db-system-view">

    <p>
        <?= Html::a('元数据', ['index', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '不要乱删，删错了，你背锅哦！',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['label'=>'数据名','value'=>$model->db_name],

            ['label'=>'表名','value'=>$model->table_name],
            ['label'=>'表描述','value'=>$model->table_desc],

            ['label'=>'字段名','value'=>$model->field_name],
            ['label'=>'字段名描述','value'=>$model->field_desc],
            ['label'=>'字段类型','value'=>DbSystem::getFileType($model->field_type)],
            ['label'=>'字段值','value'=>$model->field_value],
            ['label'=>'字段值描述','value'=>$model->field_value_desc],

            ['label'=>'数据源','value'=>DbSystem::getDbSourceType($model->source_type)],
            ['label'=>'字段状态','value'=>DbSystem::getFileStatus($model->status)],

            ['label'=>'创建人','value'=>$model->created_author],
            ['label'=>'创建时间','value'=>$model->created_at],
            ['label'=>'更新人','value'=>$model->updated_author],
            ['label'=>'更新时间','value'=>$model->updated_at],

            ['label'=>'备注','value'=>$model->comment],
            //['label'=>'操作记录','value'=>''],
        ],
    ]) ?>

</div>
