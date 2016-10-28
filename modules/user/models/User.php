<?php

namespace app\modules\user\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $userlogin
 * @property string $auth_key
 * @property string $password_hash
 * @property string $email
 */
class User extends ActiveRecord implements IdentityInterface
{
    const MIN_LENGHT_PASS = 6;
    const MIN_LENGHT_LOGIN = 2;
    const MAX_LENGHT_LOGIN = 32;

    const ADMIN_LOGIN = 'admin';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['userlogin', 'required'],
            ['userlogin', 'match', 'pattern' => '#^[\w_-]+$#i'],
            ['userlogin', 'unique', 'targetClass' => self::className(), 'message' => 'This username has already been taken.'],
            ['userlogin', 'string', 'min' => self::MIN_LENGHT_LOGIN, 'max' => self::MAX_LENGHT_LOGIN],

            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => self::className(), 'message' => 'This email address has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => Yii::t('app', 'Создан'),
            'updated_at' => Yii::t('app', 'Обновлён'),
            'login' => Yii::t('app', 'Логин'),
            'password' => Yii::t('app', 'Пароль'),
            'email' => Yii::t('app', 'Email')

        ];
    }

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
     * Блок управления записью пользователя в БД
     * Установка хеша пароля
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Генерация ключа аутентификации
     *
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->generateAuthKey();
            }
            return true;
        }
        return false;
    }

    /**
     * Блок для работы формы авторизации пользователя
     * Поиск по userlogin
     *
     * @param string $userlogin
     * @return static|null
     */
    public static function findByUsername($userlogin)
    {
        return static::findOne(['userlogin' => $userlogin]);
    }

    /**
     * Валидация пароля
     *
     * @param string $password
     * @return boolean
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * @param int|string $id
     * @return null|static
     */

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function isAdmin() {
        return ($this->userlogin == self::ADMIN_LOGIN) ? true : false;
    }

}
