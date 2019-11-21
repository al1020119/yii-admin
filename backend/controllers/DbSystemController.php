<?php

namespace backend\controllers;

use common\helper\CacheHelper;
use common\helper\FilterHalper;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use backend\models\AdminUser;
use backend\models\DbSystemRecord;
use backend\models\DbSystemRecordSearch;
use backend\models\DbSystem;
use backend\controllers\common\MetaBaseController;

use common\services\ConstantService;
use common\services\UtilService;
use backend\models\User;


/**
 * RawsController implements the CRUD actions for Raws model.
 */
class DbSystemController extends MetaBaseController
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

        $search_field = trim( $this->get("search_field","" ) );
        $status = intval( $this->get("status",ConstantService::$status_default ) );
        $p = intval( $this->get("p",1) );
        $p = ( $p > 0 ) ? $p : 1;

        $query = DbSystem::find();
        if( $search_field ){
            $query->orFilterWhere(['like', 'table_desc', $search_field])
                ->orFilterWhere(['like', 'field_desc', $search_field])
                ->orFilterWhere(['like', 'field_value_desc', $search_field])
                ->orFilterWhere(['like', 'created_author', $search_field])
                ->orFilterWhere(['like', 'updated_author', $search_field])
                ->orFilterWhere(['like', 'comment', $search_field]);
        }

        // 不限制的时候不加入状态查询
        $search_status = $status < ConstantService::$status_default;
        if( $search_status ){
            $query->andWhere([ 'status' => $status ]);
        }

        $db_name = Yii::$app->cache->get('db_name');
        $search_db_name = $db_name && !FilterHalper::hasChinese($db_name);
        if( $search_db_name ){
            $query->andWhere([ 'db_name' => $db_name ]);
        }

        $table_name = Yii::$app->cache->get('table_name');
        $search_table_name = $table_name && !FilterHalper::hasChinese($table_name);
        if( $search_table_name ){
            $query->andWhere([ 'table_name' => $table_name ]);
        }

        $field_name = Yii::$app->cache->get('field_name');
        $search_field_name = $field_name && !FilterHalper::hasChinese($field_name);
        if( $search_field_name ){
            $query->andWhere([ 'field_name' => $field_name ]);
        }

        //分页功能,需要两个参数，1：符合条件的总记录数量  2：每页展示的数量
        //60,60 ~ 11,10 - 1
        //分页功能已被优化成统一方法 可参考 UtilService::ipagination

        $offset = ($p - 1) * $this->page_size;
        $total_res_count = $query->count();

        $pages = UtilService::ipagination([
            'total_count' => $total_res_count,
            'page_size' => $this->page_size,
            'page' => $p,
            'display' => 10
        ]);

        /*
            //TODO: 当选择条件有限(只选择状态，不用全表查)
            $search_pages_size = $this->page_size;
            if ($search_status || $search_db_name || $search_table_name || $search_field_name) {
                $search_pages_size = PHP_INT_MAX;
            }
        */

        $list = $query->orderBy([ 'updated_at' => SORT_DESC, 'created_at' => SORT_DESC ])
            ->offset($offset)
            ->limit($this->page_size)
            ->all( );

        return $this->render("index",[
            "pages" => $pages,
            'list' => $list,
            'search_conditions' => [
                'search_field' => $search_field,
                'p' => $p,
                'status' => $status,
            ],
            'status_mapping' => ConstantService::$status_mapping,
        ]);
    }

    /**
     * Displays a single Raws model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionLastMeta(){
//        $last_access = AdminUser::getSelfModel()->last_access;
//        $list = DbSystem::find()->where(['or' , 'updated_at' > $last_access , 'created_at' > $last_access])->orderBy([ 'updated_at' => SORT_DESC, 'created_at' => SORT_DESC ])->all();
//        echo '==================================最近一次访问之后的更新数据==================================';
//        var_dump($list);
    }

    /**
     * Creates a new Raws model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DbSystem();

        if ($model->load(Yii::$app->request->post())) {
            $username = AdminUser::getUserName();
            $model->created_author = $username;
            $model->updated_author = $username;
            $model->save();
            // 将操作记录写到记录表
            $this->storeActionRecord(DbSystemRecord::ACTION_CREATE, $model);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Raws model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $username = AdminUser::getUserName();
            $model->updated_author = $username;
            $transaction = Yii::$app->db->beginTransaction();
            try {
                // 保存前，将操作记录写到记录表
                $this->storeActionRecord(DbSystemRecord::ACTION_UPDATE, $model);
                $model->save();
                $transaction->commit();
                return $this->redirect(['view', 'id' => $model->id]);
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('danger',$e->getMessage());
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Raws model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $this->storeActionRecord(DbSystemRecord::ACTION_DELETE, $model);
            $model->delete();
            $transaction->commit();
            return $this->redirect(['index']);
        } catch (\Exception $e) {
            $transaction->rollBack();
            Yii::$app->session->setFlash('danger','iCocos : '. $e->getMessage());
        }
    }

    /**
     * Finds the Raws model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DbSystem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DbSystem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function storeActionRecord($actionType,$model)
    {
        $record = new DbSystemRecord();
        $record->meta_id = $model->id;
        $record->author = $model->updated_author;
        $record->action_type = $actionType;
        $record->created_at = $model->updated_at;
        $record->updated_at = $model->updated_at;
        if ($actionType==DbSystemRecord::ACTION_UPDATE) {
            $dbModel = $this->findModel($model->id);
            $actions = [];
            foreach ($dbModel as $key => $value) {
                if (isset($model[$key]) && $model[$key] != $value
                    && $key!='updated_author' && $key!='updated_at'
                    &&$key!='created_author' && $key!='created_at') {
                    $actions[$key] = $model[$key];
                }
            }
            if (count($actions) != 0) {
                $record->action_content = json_encode($actions);
                $record->save();
            }
        } else {
            $dmlContent = [];
            foreach ($model as $key => $value) {
                if ($key!='id' && $key!='updated_author' && $key!='updated_at'
                    &&$key!='created_author' && $key!='created_at') {
                    $dmlContent[$key] = $model[$key];
                }
            }
            $record->action_content = json_encode($dmlContent);
            $record->save();
        }
    }

    public function actionActionRecord()
    {
        $meta_id = Yii::$app->request->get('id');
        $searchModel = new DbSystemRecordSearch();
        $dataProvider = $searchModel->search(['meta_id' => $meta_id]);
        return $this->render('record', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'meta_id' => $meta_id
        ]);
    }

    /*查询表*/
    public function actionMetaTable() {
        $type = isset($_POST["type"]) ? $_POST["type"] : "";
        $parent_name = isset($_POST["parent_name"]) ? $_POST["parent_name"] : "";

        if ($type == "" || $parent_name == "") {
            CacheHelper::destorySearchQuery();
            return json_encode([]);
        } else {
            if ($type=='db') {
                CacheHelper::destorySearchQuery();
                Yii::$app->cache->set('db_name',$parent_name);
                $json_data = DbSystem::getMetaTableNameJSON($parent_name,true);
                return $json_data;
            } elseif ($type=='table') {
                Yii::$app->cache->set('table_name',$parent_name);
                $json_data =  DbSystem::getMetaFieldNameJSON($parent_name,true);
                return $json_data;
            } elseif ($type=='field') {
                Yii::$app->cache->set('field_name',$parent_name);
                return json_encode([Yii::$app->cache->get('db_name'),Yii::$app->cache->get('table_name'),Yii::$app->cache->get('field_name')]);
            } else {
                CacheHelper::destorySearchQuery();
                return json_encode([]);
            }
        }
    }

}
