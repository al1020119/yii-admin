<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\DbSystem;

/* @var $this yii\web\View */
/* @var $model backend\models\DbSystem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="raws-form">

    <?php $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data','class' => 'form-horizontal'],
        'fieldConfig' => [  //统一修改字段的模板
            'template' => "{label}\n<div class=\"col-lg-5\">{input}</div>\n<div class=\"col-lg-3\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],  //修改label的样式
        ],
    ]); ?>

    <?= $form->field($model, 'db_name')->textInput(['maxlength' => true,'placeholder'=>'请输入数据库名']);?>

    <?= $form->field($model, 'table_name')->textInput(['maxlength' => true,'placeholder'=>'请输入表名']) ?>

    <?= $form->field($model, 'table_desc')->textInput(['maxlength' => true,'placeholder'=>'请输入表描述']) ?>

    <?= $form->field($model, 'field_name')->textInput(['maxlength' => true,'placeholder'=>'请输入字段名']) ?>

    <?= $form->field($model, 'field_desc')->textInput(['maxlength' => true,'placeholder'=>'请输入字段描述']) ?>

    <?= $form->field($model, 'field_type')->dropDownList(DbSystem::getFileType(null), ['prompt' => '请选择字段类型']) ?>

    <?= $form->field($model, 'field_value')->textInput(['maxlength' => true,'placeholder'=>'请输入字段值']) ?>

    <?= $form->field($model, 'field_value_desc')->textInput(['maxlength' => true,'placeholder'=>'请输入字段值描述']) ?>

    <?= $form->field($model, 'source_type')->dropDownList(DbSystem::getDbSourceType(null), ['prompt' => '请选择数据源']) ?>

    <?= $form->field($model, 'status')->dropDownList([1 => '使用中', 0 => '已废弃'], ['prompt' => '请选择字段状态']) ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true,'placeholder'=>'请输入备注']) ?>

    <!--时间和操作人，通过代码控制-->
    <?php //$model->isNewRecord ? $form->field($model,'created_author')->input('text',['value'=>AdminUser::getUserName(),'readonly' => 'true']) : $form->field($model, 'created_author')->input('text',['value'=>$model->created_author,'readonly' => 'true']); ?>
    <?php //$model->isNewRecord ? $form->field($model,'created_at')->input('text',['value'=>date("Y-m-d H:i:s",time()+8*60*60),'readonly' => 'true']) : $form->field($model, 'created_at')->input('text',['value'=>$model->created_at,'readonly' => 'true']); ?>

    <?php //$model->isNewRecord ? $form->field($model,'updated_author')->input('text',['value'=>AdminUser::getUserName(),'readonly' => 'true']) : $form->field($model, 'updated_author')->input('text',['value'=>AdminUser::getUserName(),'readonly' => 'true']); ?>
    <?php //$model->isNewRecord ? $form->field($model,'updated_at')->input('text',['value'=>date("Y-m-d H:i:s",time()+8*60*60),'readonly' => 'true']) : $form->field($model, 'updated_at')->input('text',['value'=>date("Y-m-d H:i:s",time()+8*60*60),'readonly' => 'true']); ?>

    <?php //$form->field($model, 'created_author')->textInput(['maxlength' => true]) ?>
    <?php //$form->field($model, 'created_at')->widget(\kartik\datetime\DateTimePicker::className(),['options' => ['placeholder' => ''],'pluginOptions' => ['autoclose' => true,]]) ?>

    <?php //$form->field($model, 'updated_author')->textInput(['maxlength' => true]) ?>
    <?php //$form->field($model, 'updated_at')->widget(\kartik\datetime\DateTimePicker::className(),['options' => ['placeholder' => ''],'pluginOptions' => ['autoclose' => true,]]) ?>
    <!--时间和操作人，通过代码控制-->

    <div class="form-group col-lg-1 control-label" style="width: 100px;margin-bottom: 100px;">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
