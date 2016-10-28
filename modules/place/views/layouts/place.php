<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <meta name="description" content="EXTREME NAVIGATOR – путеводитель  для любителей экстремального спорта и отдыха.
    На карте вы найдете самые экстремальные места. Присоединяйтесь к миру экстрима!">
        <meta name="keywords" content="сайт экстрим самые экстремальные любители мир карта спорт место необычный">
        <?php $this->head() ?>
    </head>
        <body>
        <?php $this->beginBody() ?>
            <?= Html::beginTag('header', ['class' => 'page-header']) ?>
                <?= Html::tag('div', '', ['id' => 'white']) ?>
                <?php
                NavBar::begin([
                    'brandLabel' => Yii::$app->name,
                    'brandUrl' => Yii::$app->homeUrl,
                    'options' => [
                        'class' => 'navbar-inverse navbar-fixed-top',
                        'tag' => 'div',
                    ],
                    'brandOptions' => [
                        'class' => 'logo',
                    ]
                ]);
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => array_filter([
                        ['label' => 'Home', 'url' => ['/main/default/index']],
                        ['label' => 'About', 'url' => ['/main/default/about']],
                        ['label' => 'Contact', 'url' => ['/main/contact/index']],
                        Yii::$app->user->isGuest ? (['label' => 'Sign Up', 'url' => ['/user/default/signup']]) : false,
                        !Yii::$app->user->isGuest ? (['label' => 'Create Place', 'url' => ['/place/default/create']]) : false,
                        Yii::$app->user->isGuest ?
                            ['label' => 'Login', 'url' => ['/user/default/login']] :
                            ['label' => 'Logout (' . Yii::$app->user->identity->userlogin . ')',
                                'url' => ['/user/default/logout'],
                                'linkOptions' => ['data-method' => 'post']
                            ],
                    ]),
                ]);
                NavBar::end();
                ?>
            <?= Html::endTag('header') // page-header ?>
            <?= Html::beginTag('section', ['class' => 'main-content', 'style' => 'margin-top: 130px']) ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            <?= Html::endTag('section') // main-content ?>
            <?= $this->render('footer') ?>
        <?php $this->endBody() ?>
        </body>
    </html>
<?php $this->endPage() ?>