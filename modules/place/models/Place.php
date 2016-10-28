<?php

namespace app\modules\place\models;

use app\models\Photo;
use app\models\PlaceRating;
use app\modules\category\models\Category;
use app\modules\city\models\City;
use app\modules\comment\models\Comment;
use app\modules\user\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Класс модели для таблицы {{%place))
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $author_id
 * @property integer $category_id
 * @property integer $city_id
 * @property string $coordinates
 * @property integer $rating
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Comment[] $comments
 * @property Photo[] $photos
 * @property PlaceRating $placeRating
 * @property Category $category
 * @property City $city
 * @property User $author
 */
class Place extends ActiveRecord
{

    const MAX_LENGHT_TITLE_PLACE = 70;
    const MAX_LENGHT_COORDINATES = 100;
    const MAX_COUNT_FILES = 10;

    public $file;

    /**
     * Функция поведения
     * @return array
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * Функция события
     * @return bool
     */
    public function beforeValidate()
    {
      $name_city = $this->city_id;
      $actionName = Yii::$app->controller->action->id;

       if ($actionName == "update" || $actionName == "create"){
         $city_id = City::findOne(['name_city'=>$name_city])->id;
         if($city_id){
           $this->city_id = $city_id;
         } else {
           $city = new City;
           $city->name_city = $name_city;
           $city->save();
           $this->city_id = City::findOne(['name_city'=>$name_city])->id;
         }

       }

      parent::beforeValidate();
      return true;
    }

    /**
     * Название таблицы в БД
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%places}}';
    }

    /**
     * Функция правил
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'author_id', 'category_id', 'city_id', 'coordinates'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => self::MAX_LENGHT_TITLE_PLACE],
            [['coordinates'], 'string', 'max' => self::MAX_LENGHT_COORDINATES],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['file'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => self::MAX_COUNT_FILES],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Название'),
            'description' => Yii::t('app', 'Описание'),
            'author_id' => Yii::t('app', 'Автор'),
            'category_id' => Yii::t('app', 'Категория'),
            'city_id' => Yii::t('app', 'Город'),
            'coordinates' => Yii::t('app', 'Координаты'),
            'rating' => Yii::t('app', 'Рейтинг'),
            'created_at' => Yii::t('app', 'Дата создания'),
            'updated_at' => Yii::t('app', 'Дата обновления'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(Photo::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceRating()
    {
        return $this->hasOne(PlaceRating::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    public function getAuthorName()
    {
        $author = User::findOne($this->author_id);
        return $author->userlogin;
    }

    public function IsAuthor()
    {
        if (Yii::$app->user->id == $this->author_id)
            return true;
        else {
            return false;
        }
    }

    public function getFolderPhoto()
    {
        $folder = 'images/' . $this->getPrimaryKey() . '/';
        if (is_dir($folder) == false)
            mkdir($folder, 0777, true);
        return $folder;
    }

    public function getPhotosName()
    {
        return Photo::find()->where(['place_id' => $this->getPrimaryKey()])->all();

    }

    public function getMainImage()
    {
        return Photo::find()->where(['place_id' => $this->getPrimaryKey()])->one()->filename;
    }
    //удаление папки с фотографиями при удалении записи 
    public static function delImagesFile($id)
    {
      $photo = Photo::find()->where(['place_id' => $id])->all();
      foreach($photo as $file){
        if(file_exists("images/".$id.'/'.$file->filename)){
          unlink("images/".$id.'/'.$file->filename);
        }
      }
      rmdir("images/".$id);
    }
}
