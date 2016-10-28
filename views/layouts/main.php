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
use app\modules\main\models\SearchModel;

AppAsset::register($this);
$searchModel = new SearchModel();
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
<?= Html::beginTag('div', ['class' => 'wrapper']) ?>
    <?= Html::beginTag('div', ['class' => 'page']) ?>
        <?= Html::beginTag('header', ['class' => 'page-header']) ?>
            <?= Html::tag('div', '', ['id' => 'white']) ?>

            <div class="page-header-container">
              <div id="header-nav">
                  <?= $this->render('@app/modules/main/views/default/_search', ['model' => $searchModel]); ?>
              </div>
              <div class="links">
                <div class="account-wrapper">
                  <?php if (Yii::$app->user->isGuest):?>

                    <a href="/user/default/signup" class="header-link header-login">
                       <span>Регистрация</span>
                    </a>

                    <a href="/user/default/login" class="header-link header-login">
                        <span>Вход</span>
                    </a>
                  <?php else: ?>
                      <a href="/user/default/logout" class="header-link header-login" data-method = "post">
                         <span><?='Выход (' . Yii::$app->user->identity->userlogin . ')'?></span>
                     </a>
             <?php endif ?>
                </div>
              </div>
              <div class="links">
                <div class="place-wrapper">
                  <?php if (!Yii::$app->user->isGuest):?>
                  <a href="/place/create" class="header-link header-place">
                    <span>Добавить экстремальное место</span>
                  </a>
                <?php endif ?>
                </div>
              </div>
              <a class="logo" href="/" title="Экстрим-сайт о местах для экстремальных путешествий и экстремального спорта.">
                <div class="logo-container"></div>
              </a>
            </div>
        <?= Html::endTag('header') // page-header ?>
        <?= Html::beginTag('section', ['class' => 'main-container']) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
            <?= $this->render('footer') ?>
        <?= Html::endTag('section') // main-container ?>

    <?= Html::endTag('div') // page?>

<?= Html::endTag('div') //wrapper?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
