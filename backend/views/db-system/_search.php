<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DbSystemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="db-system-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'db_name') ?>

    <?= $form->field($model, 'table_name') ?>

    <?= $form->field($model, 'table_desc') ?>

    <?= $form->field($model, 'field_name') ?>

    <?= $form->field($model, 'field_desc') ?>

    <?= $form->field($model, 'field_type') ?>

    <?= $form->field($model, 'field_value') ?>

    <?= $form->field($model, 'field_value_desc') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'created_author') ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'updated_author') ?>

    <?= $form->field($model, 'updated_at') ?>

    <?= $form->field($model, 'comment') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
