<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\category\models\category;
use app\modules\city\models\City;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\place\models\Place */
/* @var $form yii\widgets\ActiveForm */
?>

  <div class="place-default-form">

      <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
      <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Название места *') ?>
      <?= $form->field($model, 'description')->textarea(['rows' => 6])->label('Описание места *'); ?>
      <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Category::find()->orderBy('name_category')->all(), 'id', 'name_category'), ['prompt' => Yii::t('yii', 'выберите категорию')])->label('Категория *'); ?>
      <?= $form->field($model, 'city_id')->textInput(['list' => 'city'])->label('Город *') ?>
      <datalist id="city">
          <?php foreach (ArrayHelper::map(City::find()->orderBy('name_city')->all(), 'id', 'name_city') as $id => $name_city): ?>
              <option><?= $name_city ?></option>
          <?php endforeach ?>
      </datalist>
      <?= $form->field($model, 'coordinates')->textInput(['maxlength' => true])->label('Координаты *'); ?>
      <?= $form->field($model, 'file[]')->fileInput(['multiple' => true])->label('Фотографии места'); ?>
      <div class="form-group">
          <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
      </div>
      <?php ActiveForm::end(); ?>
  </div>
