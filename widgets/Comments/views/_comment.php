<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $model app\modules\Comment\models\Comment */
?>
<?=Html::beginTag('div',['class'=>'comment-block']);?>
	<?=Html::beginTag('div',['class'=>'comment-block__avatar']);?>
		<img src="/images/f00/user_1.jpg" alt="Фото пользователя">
		<?= Html::tag('h5',Html::encode($model->author->userlogin)); ?>
	<?=Html::endTag('div');?>
    <?=Html::beginTag('div',['class'=>'comment-block__content']);?>
		<?=Html::beginTag('article');?>
			<?= Html::tag('p', Html::encode($model->comment)); ?>
            <?php if($model->isAuthor()): ?>
                <?php if((time() - $model->updated_at) < 3600): ?>
                    <?= Html::beginTag('a', [
                        'href' => Url::to(['/comment/default/update', 'id' => $model->id]),
                        'title' => 'Редактировать',
                    ]) ?>
                        <?= Html::tag('i', '', ['class' => 'fa fa-pencil', 'aria-hidden' => true]) ?>
                    <?= Html::endTag('a') ?>
                    <?= Html::beginTag('a', [
                        'href' => Url::to(['/comment/default/delete', 'id' => $model->id]),
                        'title' => 'Удалить',
                        'data' => [
                            'confirm' => Yii::t('app', 'Вы уверены что хотите удалить это сообщение?'),
                            'method' => 'post',
                        ],
                    ]) ?>
                        <?= Html::tag('i', '', ['class' => 'fa fa-trash', 'aria-hidden' => true]) ?>
                    <?= Html::endTag('a') ?>
                <? endif ?>
            <? endif ?>
		<?=Html::endTag('article');?>
	<?=Html::endTag('div');?>
    <?=Html::beginTag('div',['class'=>'comment-block__rating']);?>
		<?= Html::tag('p', 'Рейтинг: '.Html::Tag('span').
			Html::tag('span', 'Добавлен '. date("d.m.y H:i:s", $model->created_at))); ?>
	<?=Html::endTag('div');?>
    <?=Html::beginTag('div',['style'=>'clear: both'])?>
	<?=Html::endTag('div');?>
<?=Html::endTag('div');?>
