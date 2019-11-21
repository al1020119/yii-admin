<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * RawsSearch represents the model behind the search form about `backend\models\Raws`.
 */
class DbSystemSearch extends DbSystem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['db_name', 'table_name', 'table_desc', 'field_name', 'field_desc', 'field_type', 'field_value', 'field_value_desc', 'created_author', 'updated_author', 'created_at', 'updated_at','comment'], 'safe'],
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
        $query = DbSystem::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 30, //每页显示条数
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'db_name', $this->db_name])
            ->andFilterWhere(['like', 'table_name', $this->table_name])
            ->andFilterWhere(['like', 'table_desc', $this->table_desc])
            ->andFilterWhere(['like', 'field_name', $this->field_name])
            ->andFilterWhere(['like', 'field_desc', $this->field_desc])
            ->andFilterWhere(['like', 'field_type', $this->field_type])
            ->andFilterWhere(['like', 'field_value', $this->field_value])
            ->andFilterWhere(['like', 'field_value_desc', $this->field_value_desc])
            ->andFilterWhere(['like', 'source_type', $this->source_type])
            ->andFilterWhere(['like', 'created_author', $this->created_author])
            ->andFilterWhere(['like', 'updated_author', $this->updated_author])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
