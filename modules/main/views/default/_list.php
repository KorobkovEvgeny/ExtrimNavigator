<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $model app\modules\place\models\Place */
?>
    <div class='home-block home-block<?= $key?>'>
        <?php if($index%2 == 0):?>
            <a class="half right" href="<?= Url::to(['/place/default/view', 'id' => $model->id])?>" title="<?= Html::encode($model->name) ?>">
                <?php if($model->getPhotos()->count() == 0) { ?>
                    <img src="/images/f00/1.png"/>
                <?php } else { ?>
                    <img src="/images/<?=$model->id.'/'.$model->getMainImage()?>"/>
                <?php } ?>
            </a>
            <div class="half left">
                <?= Html::tag('h2', Html::encode($model->name), ['class' => 'block-title']) ?>
                <?= Html::tag('p', Html::encode($model->description), ['class' => 'block-desk']) ?>
                <p><?= Html::a(Yii::t('app','Узнать больше'), Url::to(['/place/default/view', 'id' => $model->id]), ['class' => 'block-button']) ?></p>
                <p></p>
            </div>
        <?php else: ?>
            <a class="half left" href="<?= Url::to(['/place/default/view', 'id' => $model->id])?>" title="<?= Html::encode($model->name) ?>">
                <?php if($model->getPhotos()->count() == 0) { ?>
                    <img src="/images/f00/1.png"/>
                <?php } else { ?>
                    <img src="/images/<?=$model->id.'/'.$model->getMainImage()?>"/>
                <?php } ?>
            </a>
            <div class="half right">
                <?= Html::tag('h2', Html::encode($model->name), ['class' => 'block-title']) ?>
                <?= Html::tag('p', Html::encode($model->description), ['class' => 'block-desk']) ?>
                <p><?= Html::a(Yii::t('app','Узнать больше'), Url::to(['/place/default/view', 'id' => $model->id]), ['class' => 'block-button']) ?></p>
                <p></p>
            </div>
         <?php endif; ?>
    </div>
