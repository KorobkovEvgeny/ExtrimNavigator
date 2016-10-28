<?php

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\modules\user\models\SignupForm */

$this->title = Yii::t('app', 'Регистрация');
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Html::beginTag('div',['class'=>'container', 'style'=>'margin-top: 130px;']) ?>
<div class="user-defualt-signup">
    <?= Html::tag('p', Yii::t('app', 'Пожалуйста, заполните следующие поля:')) ?>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($model, 'userlogin')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'captchaAction' => '/user/default/captcha',
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            ]) ?>
            <?= $form->field($model, 'rememberMe')->checkbox() ?>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Регистрация'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?= Html::endTag('div') ?>
