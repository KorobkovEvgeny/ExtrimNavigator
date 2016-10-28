<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<?= Html::beginTag('div', ['class' => 'footer-container']) ?>
    <?= Html::tag('div') ?>
    <?= Html::beginTag('div', ['class' => 'footer']) ?>
        <?= Html::beginTag('div', ['class' => 'actions']) ?>
           <!-- <?/*= Html::beginTag('button', [
                'class' => 'button',
                'type' => 'button',
                'title' => 'Subscribe',
            ]) */?>
                <?/*= Html::a('Ещё больше историй', Url::to(['/'])) */?>
            --><?/*= Html::endTag('button') */?>
            <?= Html::button('Ещё больше историй', [
                'class' => 'button',
                'type' => 'button',
                'title' => 'Subscribe',
                ''
            ]) ?>
        <?= Html::endTag('div') // actions ?>
        <?= Html::beginTag('div', ['id' => 'menu-footer']) ?>
            <?= Html::tag('h3', 'Наш сайт – некоммерческий проект, задуман, как каталог экстремальных мест,
                        где любители экстремального отдыха или экстремального спорта могут найти интересные места где можно
                        экстремально провести время. Ищите на карте нужный маркер или в каталоге выберите вид экстрима.', ['class' => 'footer-title']) ?>
            <?= Html::tag('b', ' Сейчас здесь представлена лишь малая часть мест для экстремального отдыха.
                        Мы развиваем наш проект и приглашаем всех поделится своими любимыми местами для экстрима!') ?>
            <?= Html::beginTag('div', ['class' => 'links-footer']) ?>
                <?= Html::beginTag('ul') ?>
                    <?= Html::beginTag('li') ?>
                        <?= Html::a('Свяжитесь с нами', Url::to(['/contact'])) ?>
                    <?= Html::endTag('li') ?>
                    <?= Html::beginTag('li') ?>
                        <?= Html::a('Политика Конфиденциальности', Url::to(['/privacyPolicy'])) ?>
                    <?= Html::endTag('li') ?>
                <?= Html::endTag('ul') ?>
            <?= Html::endTag('div') // links-footer ?>
            <?= Html::beginTag('div', ['class' => 'links-footer last']) ?>
                <?= Html::beginTag('ul') ?>
                    <?= Html::beginTag('li') ?>
                        <?= Html::a('Зарегистрируйтесь', Url::to(['/signup'])) ?>
                    <?= Html::endTag('li') ?>
                    <?= Html::beginTag('li') ?>
                        <?= Html::a('Личный кабинет', Url::to(['/profile'])) ?>
                    <?= Html::endTag('li') ?>
                <?= Html::endTag('ul') ?>
            <?= Html::endTag('div') // links-footer last?>
        <?= Html::endTag('div') // menu-footer ?>
        <?= Html::beginTag('div', ['id' => 'social-footer', 'class' => 'social']) ?>
            <?= Html::tag('h3', 'Ищите нас в социальных сетях', ['class' => 'footer-title']) ?>
            <?= Html::beginTag('ul') ?>
                <?= Html::beginTag('li') ?>
                    <?= Html::a('', 'https://www.facebook.com', [
                        'alt' => 'facebook',
                        'target' => '_blank',
                    ]) ?>
                    <?= Html::tag('i', '', [
                        'class' => 'fa fa-facebook-official',
                        'aria-hidden' => 'true',
                    ]) ?>
                <?= Html::endTag('li') ?>
                <?= Html::beginTag('li') ?>
                    <?= Html::a('', 'https://instagram.com', [
                        'alt' => 'instagram',
                        'target' => '_blank',
                    ]) ?>
                    <?= Html::tag('i', '', [
                        'class' => 'fa fa-instagram',
                        'aria-hidden' => 'true',
                    ]) ?>
                <?= Html::endTag('li') ?>
                <?= Html::beginTag('li') ?>
                    <?= Html::a('', 'https://twitter.com', [
                        'alt' => 'twitter',
                        'target' => '_blank',
                    ]) ?>
                    <?= Html::tag('i', '', [
                        'class' => 'fa fa-twitter',
                        'aria-hidden' => 'true',
                    ]) ?>
                <?= Html::endTag('li') ?>
            <?= Html::endTag('ul') ?>
        <?= Html::endTag('div') // social ?>
        <?= Html::beginTag('address', ['class' => 'copyright']) ?>
            &copy; <?= date('Y') ?> <?= Html::tag('b', Yii::$app->name) . '-сайт о местах для экстремальных путешествий и экстремального спорта' ?>
            <?= Html::beginTag('a', [
                    'href' => Url::to(['/main/default/index']),
                    'class' => 'logo-footer',
                    'title' => 'Экстрим-сайт о местах для экстремальных путешествий и экстремального спорта',
                ]) ?>
                <?= Html::img('@web/images/f00/logo2-01.png', [' class' => 'large', 'alt' => 'extreme_navigator']) ?>
            <?= Html::endTag('a') ?>
        <?= Html::endTag('address') // copyright?>
    <?= Html::endTag('div') // footer ?>
<?= Html::endTag('div') // footer-container ?>