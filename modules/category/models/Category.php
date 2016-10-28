<?php

namespace app\modules\category\models;

use app\behaviors\Slug;
use app\modules\place\models\Place;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property string $name
 * @property string $name_category
 * @property integer $created_at
 *
 * @property Place[] $places
 */
class Category extends ActiveRecord
{
    const MAX_LENGTH_CATEGORY = 80;

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            'slug' => [
                'class' => Slug::className(),
                'in_attribute' => 'name_category',
                'out_attribute' => 'name',
                'translit' => true
            ]
        ];

    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%categories}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'name_category'], 'string', 'max' => self::MAX_LENGTH_CATEGORY],
            [['name_category'], 'required'],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name_category' => Yii::t('app', 'Название категории'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaces()
    {
        return $this->hasMany(Place::className(), ['category_id' => 'id']);
    }
}
