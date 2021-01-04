<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SubCategory;

/**
 * SubCategorySearch represents the model behind the search form of `app\models\SubCategory`.
 */
class SubCategorySearch extends SubCategory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'r_cat_id'], 'integer'],
            [['c_name'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = SubCategory::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'r_cat_id' => $this->r_cat_id,
        ]);

        $query->andFilterWhere(['like', 'c_name', $this->c_name]);

        return $dataProvider;
    }
}
