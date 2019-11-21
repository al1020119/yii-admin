<?php
$session = Yii::$app->session;
?>
<div class="row">
    <?php if($session->hasFlash('error')):?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?=$session->getFlash('error')?>
        </div>
    <?php endif;?>
    <?php if($session->hasFlash('success')):?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?=$session->getFlash('success')?>
        </div>
    <?php endif;?>
    <?php if($session->hasFlash('info')):?>
        <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?=$session->getFlash('info')?>
        </div>
    <?php endif;?>
</div>