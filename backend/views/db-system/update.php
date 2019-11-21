<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DbSystem */

$this->title = '元数据管理系统';// . $model->id;
$this->params['breadcrumbs'][] = ['label' => '元数据管理系统', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="db-system-update">

    <h1><?= Html::encode('更新记录') ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
