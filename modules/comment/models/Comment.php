<?php

namespace app\modules\comment\models;

use app\modules\place\models\Place;
use app\modules\user\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "comments".
 *
 * @property integer $id
 * @property integer $place_id
 * @property string $comment
 * @property integer $author_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Place $place
 * @property User $author
 */
class Comment extends ActiveRecord
{
    const MAX_LENGTH_COMMENT = 255;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['place_id', 'comment', 'author_id'], 'required'],
            [['comment'], 'string', 'max' => self::MAX_LENGTH_COMMENT],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['place_id' => 'id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'place_id' => Yii::t('app', 'Place ID'),
            'comment' => Yii::t('app', 'Комментарий'),
            'author_id' => Yii::t('app', 'Author ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
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
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    public function isAuthor()
    {
        return (Yii::$app->user->identity->id == $this->author_id) ? true : false;
    }
}
