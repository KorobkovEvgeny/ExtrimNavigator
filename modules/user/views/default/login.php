<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\modules\user\models\LoginForm */

$this->title = Yii::t('app', 'Авторизация');
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Html::beginTag('div',['class'=>'container', 'style'=>'margin-top: 130px;']) ?>
<div class="user-defualt-login">
    <?= Html::tag('p', Yii::t('app', 'Пожалуйста, заполните следующие поля для входа:')) ?>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?= $form->field($model, 'userlogin')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'rememberMe')->checkbox() ?>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Войти'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?=Html::endTag('div');?>
