<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\place\models\Place */

//$this->title = Yii::t('app', 'Create Place');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Places'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="place-default-create">
    <?= Html::beginTag('section', ['class'=>'main-content']);?>
      <?= Html::beginTag('div',['class'=>'container']);?>
        <?= Html::beginTag('div', ['class'=>'main-content__place']);?>
          <?= Html::Tag('h2','Новое экстремальное место');?>
          <?= Html::Tag('h3','Информация о месте');?>
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        <?=Html::endTag('div');?>
      <?= Html::endTag('div');?>
    <?= Html::endTag('section');?>
</div>
