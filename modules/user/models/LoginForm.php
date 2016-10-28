<?php

namespace app\modules\user\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    const TIME_REMEMBER_COOKIES_TRUE = 2592000; //месяц
    const TIME_REMEMBER_COOKIES_FALSE = 0;

    public $userlogin;
    public $password;
    public $rememberMe = true;

    private $_user = false;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['userlogin', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Функция отображения атрибутов
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'userlogin' => 'Имя пользователя',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня',
        ];
    }

    /**
     * Валидация пароля.
     */
    public function validatePassword()
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError('password', 'Incorrect username or password.');
            }
        }
    }

    /**
     * Авторизация пользователя
     * @return boolean
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? self::TIME_REMEMBER_COOKIES_TRUE : self::TIME_REMEMBER_COOKIES_FALSE);
        }
        return false;
    }

    /**
     * Поиск по [[userlogin]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->userlogin);
        }
        return $this->_user;
    }
}
