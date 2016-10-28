<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\place\models\Place */
/* @var $photo app\models\Photo */

// $this->title = Yii::t('app', 'Update {modelClass}: ', [
//         'modelClass' => 'Place',
//     ]) . $model->name;
// $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Places'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="place-default-update">
  <?= Html::beginTag('section', ['class'=>'main-content']);?>
    <?= Html::beginTag('div',['class'=>'container']);?>
      <?= Html::beginTag('div', ['class'=>'main-content__place']);?>
        <?= Html::Tag('h2','Редактирование страницы просмотра экстремального места');?>
        <?= Html::Tag('h3','Информация о месте');?>
          <?= $this->render('_update', [
            'model' => $model,
            'photo' => $photo,
          ]) ?>
      <?=Html::endTag('div');?>
    <?= Html::endTag('div');?>
  <?= Html::endTag('section');?>
</div>
