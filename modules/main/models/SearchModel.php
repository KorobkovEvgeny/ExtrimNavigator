<?php
namespace app\modules\main\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\place\models\Place;


/**
 * Поисковая модель для главной страницы (фильтры)
 */
class SearchModel extends Place
{
    const MAX_ELEMENT_IN_PAGE = 4;

    public $date_from;
    public $date_to;

    /**
     * Функция правил
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id', 'category_id', 'created_at'], 'integer'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:Y-m-d'],
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
     * Функция создания провайдера данных для модели поиска
     * @param array $params
     * @return ActiveDataProvider
     */

    public function search($params)
    {
        $query = Place::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => self::MAX_ELEMENT_IN_PAGE,
            ],
        ]);
        $this->load($params);
        if (!($this->load($params) && $this->validate())) {
            //$query->where('0=1');
            return $dataProvider;
        }
        $query
            ->andFilterWhere([
                'city_id' => $this->city_id,
                'category_id' => $this->category_id,
            ]);
        $query
            ->andFilterWhere(['>=', 'created_at', $this->date_from ? strtotime($this->date_from . ' 00:00:00') : null])
            ->andFilterWhere(['<=', 'created_at', $this->date_to ? strtotime($this->date_to . ' 23:59:59') : null]);
        return $dataProvider;
    }
}
