<?php

namespace app\models;
use app\modules\place\models\Place;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "photo".
 *
 * @property integer $id
 * @property integer $place_id
 * @property string $filename
 *
 * @property Place $place
 */
class Photo extends ActiveRecord
{

  // Удаление фото с сервера
     public function beforeDelete(){
       unlink("images/".$this->place_id.'/'.$this->filename);
       return true;
     }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%photos}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['place_id'], 'required'],
            [['place_id'], 'integer'],
            [['filename'], 'string', 'max' => 255],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['place_id' => 'id']],
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
            'filename' => Yii::t('app', 'Filename'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlace()
    {
        return $this->hasOne(Place::className(), ['id' => 'place_id']);
    }

    public function getName($name){
      return hash('sha512', $name);

    }
}
