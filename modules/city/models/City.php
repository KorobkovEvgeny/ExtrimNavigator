<?php

namespace app\modules\city\models;

use app\modules\place\models\Place;
use Yii;
use app\behaviors\Slug;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "cities".
 *
 * @property integer $id
 * @property string $city
 * @property string $name_city
 *
 * @property Place[] $places
 */
class City extends ActiveRecord
{
    const MAX_LENGTH_CITY = 50;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cities}}';
    }

    public function behaviors()
    {
        return [
            'slug' => [
                'class' => Slug::className(),
                'in_attribute' => 'name_city',
                'out_attribute' => 'city',
                'translit' => true
            ]
        ];

    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_city'], 'required'],
            [['city', 'name_city'], 'string', 'max' => self::MAX_LENGTH_CITY],
            [['city'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name_city' => Yii::t('app', 'Название города'),

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaces()
    {
        return $this->hasMany(Place::className(), ['city_id' => 'id']);
    }
}
