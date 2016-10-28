<?php

namespace app\modules\user\models;

use Yii;
use yii\base\Model;

/**
 * SignupForm is the model behind the signup form.
 *
 */
class SignupForm extends Model
{
    public $userlogin;
    public $password;
    public $email;
    public $verifyCode;
    public $rememberMe = true;

    const MIN_LENGHT_PASS = 6;
    const MIN_LENGHT_LOGIN = 2;
    const MAX_LENGHT_LOGIN = 32;
    const TIME_REMEMBER_COOKIES_TRUE = 2592000; //месяц
    const TIME_REMEMBER_COOKIES_FALSE = 0;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['userlogin', 'filter', 'filter' => 'trim'],
            ['userlogin', 'required'],
            ['userlogin', 'match', 'pattern' => '#^[\w_-]+$#i'],
            ['userlogin', 'unique', 'targetClass' => User::className(), 'message' => Yii::t('app', 'Введенное имя пользователя уже используется другим пользователем')],
            ['userlogin', 'string', 'min' => self::MIN_LENGHT_LOGIN, 'max' => self::MAX_LENGHT_LOGIN],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::className(), 'message' => Yii::t('app', 'Введенный email уже используется другим пользователем')],
            ['password', 'required'],
            ['password', 'string', 'min' => self::MIN_LENGHT_PASS],
            ['rememberMe', 'boolean'],
            ['verifyCode', 'captcha', 'captchaAction' => '/user/default/captcha'],
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
            'verifyCode' => 'Проверочный код',
        ];
    }


    /**
     * Регистрация пользователя.
     * @return User|null
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->userlogin = $this->userlogin;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return Yii::$app->user->login($user, $this->rememberMe ? self::TIME_REMEMBER_COOKIES_TRUE : self::TIME_REMEMBER_COOKIES_TRUE);
            }
        }
        return null;
    }
}
