<?php

namespace app\models;

use app\modules\place\models\Place;
use app\modules\user\models\User;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "place_rating".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $place_id
 * @property integer $rating_id
 *
 * @property Place $place
 * @property User $user
 */
class PlaceRating extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'place_rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'place_id', 'rating_id'], 'required'],
            [['user_id', 'place_id', 'rating_id'], 'integer'],
            [['user_id'], 'unique'],
            [['place_id'], 'unique'],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['place_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'place_id' => Yii::t('app', 'Place ID'),
            'rating_id' => Yii::t('app', 'Rating ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlace()
    {
        return $this->hasOne(Place::className(), ['id' => 'place_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}
