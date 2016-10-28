<?php

namespace app\modules\place\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\place\models\Place;

/**
 * PlaceSearch represents the model behind the search form about `app\modules\place\models\Place`.
 */
class PlaceSearch extends Place
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'author_id', 'category_id', 'city_id', 'rating', 'created_at', 'updated_at'], 'integer'],
            [['name', 'description', 'coordinates'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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
        $query = Place::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'author_id' => $this->author_id,
            'category_id' => $this->category_id,
            'city_id' => $this->city_id,
            'rating' => $this->rating,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'coordinates', $this->coordinates]);
        return $dataProvider;
    }
}
