<?php

namespace backend\controllers;
use backend\controllers\common\MetaBaseController;
use yii\filters\VerbFilter;

/**
 * RawsController implements the CRUD actions for Raws model.
 */
class ServicesController extends MetaBaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex(){
        return $this->render("index");
    }

    public function actionAsync(){
        return $this->render("async");
    }

    public function actionReport(){
        return $this->render("report");
    }

    public function actionJournal(){
        return $this->render("journal");
    }


}
