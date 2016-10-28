<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\comment\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comment-default-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'place_id', ['template' => '{input}'])->hiddenInput(['value' => $model->place->id]) ?>
    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'author_id', ['template' => '{input}'])->hiddenInput(['value'=> $model->author->id]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Добавить') : Yii::t('app', 'Изменить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
