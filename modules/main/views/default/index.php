<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel app\modules\main\models\SearchModel */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = 'ExtremeNavigator';
?>
<?= Html::beginTag('div', ['class' => 'main']) ?>
    <?php if (Yii::$app->session->hasFlash('successSignup')) { ?>
        <div class="alert alert-success">
            <?= Yii::t('app', 'Регистрация прошла успешно, поздравляем!') ?>
        </div>
    <? } ?>
    <?/*= $this->render('_search', ['model' => $searchModel]); */?>
    <?= Html::beginTag('div', ['class' => 'col-main']) ?>
        <?= Html::beginTag('div', ['class' => 'std']) ?>
            <?= Html::beginTag('div', ['class' => 'carousel-container']) ?>
                <?= Html::beginTag('div', ['class' => 'carousel carousel-home']) ?>
                    <?= Html::beginTag('div', [
                        'class' => 'item',
                        'style' => 'background: fixed url(\'images/f00/bx-foto.jpg\') 50% 70% no-repeat; background-size: 100% auto',
                    ]) ?>
                    <?= Html::beginTag('div', ['class' => 'slide-content']) ?>
                        <?= Html::beginTag('div', ['class' => 'slide-title']) ?>
                            <?= Html::a('Присоединится...', Url::to(['/signup'])) ?>
                            <?= Html::tag('p', 'Здесь начинается экстрим') ?>
                            <?= Html::tag('h4', 'Узнайте о самых лучших местах для любителей экстрима!') ?>
                            <a href="#" class="block-button">Карта</a>
                            <a href="#" class="block-button">Экстрим</a>
                        <?= Html::endTag('div') // slide-title ?>
                    <?= Html::endTag('div') // slide-content ?>
                    <?= Html::endTag('div') // item ?>
                    <?= Html::endTag('div') // carousel carousel-home ?>
                        <?= Html::tag('h1', 'Навигатор в экстремальном мире', ['class' => 'slider-title']) ?>
                        <?= Html::beginTag('div', ['class' => 'widget widget-static-block']) ?>
                        <?= Html::beginTag('div', ['class' => 'block-below-slider']) ?>
                        <?= Html::tag('p', 'Если вы любите экстремальный спорт, экстремальные путешествия или
                             хотите организовать прогулку в очень необычное место, на нашем сайте вы получите
                             доступ к самым лучшим местам для любителей экстрима. <br>', ['class' => 'slogan']) ?>
                    <?= Html::endTag('div') // block-below-slider?>
                    <?= Html::endTag('div') //widget widget-static-block?>
                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_list',
                    'summary' => false,
                    'emptyText' => 'В данном разделе еще нет записей. Будьте первым, кто сделает это!!!',
                    'options' => [
                        'tag' => 'div',
                        'class' => 'carousel carousel',
                    ],
                    'itemOptions' => [
                        'tag' => 'div',
                        'class' => 'widget widget-static-block',
                    ],
                ]); ?>
            <?= Html::endTag('div') // carousel-container ?>
        <?= Html::endTag('div') // std ?>
    <?= Html::endTag('div') // col-main ?>
<?= Html::endTag('div') // main ?>
