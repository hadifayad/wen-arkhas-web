<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Post;

/**
 * PostSearch represents the model behind the search form of `app\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'r_sub_category_id', 'r_user_id', 'c_price', 'c_duration'], 'integer'],
            [['c_shop_name', 'c_shop_place'], 'safe'],
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
        $query = Post::find();

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
            'r_sub_category_id' => $this->r_sub_category_id,
            'r_user_id' => $this->r_user_id,
            'c_price' => $this->c_price,
            'c_duration' => $this->c_duration,
        ]);

        $query->andFilterWhere(['like', 'c_shop_name', $this->c_shop_name])
            ->andFilterWhere(['like', 'c_shop_place', $this->c_shop_place]);

        return $dataProvider;
    }
}
