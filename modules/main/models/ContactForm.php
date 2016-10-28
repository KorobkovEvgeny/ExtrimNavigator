<?php

namespace app\modules\main\models;

use Yii;
use yii\base\Model;

/**
 * Модель для работы контактной формы
 */
class ContactForm extends Model
{
    public $userlogin;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;


    /**
     * Функция правил
     * @return array
     */
    public function rules()
    {
        return [
            [['userlogin', 'email', 'subject', 'body'], 'required'],
            ['email', 'email'],
            ['verifyCode', 'captcha', 'captchaAction' => 'main/contact/captcha'],
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
            'subject' => 'Название темы',
            'body' => 'Текст сообщения',
            'verifyCode' => 'Проверочный код',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return boolean whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([$this->email => $this->userlogin])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();
            return true;
        }
        return false;
    }
}
