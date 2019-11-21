<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\DbSystem */

$this->title = '元数据管理系统';
$this->params['breadcrumbs'][] = ['label' => '元数据管理系统', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="db-system-create">

    <h1><?= Html::encode('创建记录') ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
