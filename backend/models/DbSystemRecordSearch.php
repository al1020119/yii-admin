<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * RawsSearch represents the model behind the search form about `backend\models\Raws`.
 */
class DbSystemRecordSearch extends DbSystemRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['author', 'action_type', 'action_content', 'created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        if (empty($params)) {
            return Yii::$app->getResponse()->redirect(Yii::$app->getHomeUrl());
        }
        $query = DbSystemRecord::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at'=>SORT_ASC]],
            'pagination' => [
                'pageSize' => 30, //每页显示条数
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere(['meta_id' => $params['meta_id']]);
        return $dataProvider;
    }
}
