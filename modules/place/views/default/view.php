<?php

use app\widgets\Comments\Comments;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\place\models\Place */
/* @var $comments app\modules\comment\models\Comment */
/* @var $comment app\modules\comment\models\Comment */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->name;
Url::remember();
?>
<?= Html::beginTag('div',['class'=>'container', 'style'=>'margin-top: 130px;']) ?>
    <?= Html::beginTag('section',['class'=>'main-content__gallery']) ?>
        <?= Html::beginTag('div',['class'=>'main-content__gallery-pictures']) ?>
            <div id="thumb">
                <div id="slider3">
                    <div class="thumbelina-but vert top">&#708;</div>
                    <ul>
                        <?php foreach ($model->getPhotosName() as $photo): ?>
                            <li><img class="img-responsive" src="/images/<?= $model->id . '/' . $photo->filename ?>"/></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="thumbelina-but vert bottom">&#709;</div>
                </div>
            </div>
        <?= Html::endTag('div') // main-content__gallery-pictures ?>
        <?= Html::beginTag('div',['class'=>'main-content__gallery-preview']) ?>
            <?php if ($model->getPhotos()->count() == 0):?>
                <?= Html::img('/images/f00/1.png', ['alt'=> 'Нет загруженных фотографий']) ?>
            <?php else: ?>
                <?= Html::img("/images/$model->id/".$model->getMainImage(), ['id'=>"preview", 'class'=>"img-responsive", 'height'=>"800", 'alt'=> 'Фото экстремального места']) ?>
            <?php endif; ?>
        <?= Html::endTag('div') // main-content__gallery-preview ?>
    <?= Html::endTag('section') // main-content__gallery ?>
    <?= Html::begintag('article',['class'=>'main-content__article'])?>
        <?= Html::tag('h1', $this->title) ?>
        <?= Html::tag('p', $model->description) ?>
        <?= Html::tag('p', 'Опубликовано: '.date("d.m.y", $model->created_at), ['class'=>'article-date']) ?>
        <?= Html::tag('p', 'Автор: '.$model->getAuthorName(), ['class'=>'article-author']) ?>
        <?=Html::beginTag('div', ['class' => 'upkeep']) ?>
            <?php if ($model->IsAuthor()):?>
                <?= Html::beginTag('a', [
                    'href' => Url::to(['/place/default/update', 'id' => $model->id]),
                    'title' => 'Редактировать',
                ]) ?>
                    <?= Html::tag('i', '', ['class' => 'fa fa-pencil', 'aria-hidden' => true]) ?>
                <?= Html::endTag('a') ?>
                <?= Html::beginTag('a', [
                    'href' => Url::to(['/place/default/delete', 'id' => $model->id]),
                    'title' => 'Удалить',
                    'data' => [
                        'confirm' => Yii::t('app', 'Вы уверены что хотите удалить это сообщение?'),
                        'method' => 'post',
                    ],
                ]) ?>
                    <?= Html::tag('i', '', ['class' => 'fa fa-trash', 'aria-hidden' => true]) ?>
                <?= Html::endTag('a') ?>
            <?php endif ?>
        <?= Html::endTag('div') // upkeep ?>
    <?= Html::endTag('article') // main-content__article ?>
    <?= Html::beginTag('section',['class'=>'main-content__comments']) ?>
        <?= Comments::widget([
            'model' => $model
        ]) ?>
    <?= Html::endTag('section') // main-content__comments ?>
<?= Html::endTag('div') // container ?>
