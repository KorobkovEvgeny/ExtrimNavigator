<?php
/* @var $model app\modules\Comment\models\Comment */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

?>

<?=Html::Tag('h2','Комментарии ('.$comments->count().')');?>

<?php if ($comments->count() > 0): ?>
<?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_comment',
        'summary' => false,
]); ?>
<? endif ?>
<div class="comment-form-container">
    <?php if(!Yii::$app->user->isGuest): ?>
        <?php $form = ActiveForm::begin([
            'options' => [
                'class' => 'create-comment'
            ],
            'action' => Url::to(['/comment/default/create']),
            'validateOnChange' => false,
            'validateOnBlur' => false,
        ])?>
		<?= Html::label('Добавить комментарий','comment');?>
        <?= $form->field($commentModel, 'comment', ['template' => '{input}{error}'])->textarea(['rows' => 4, 'data' => ['comment' => 'comment'], 'id'=>'comment'])?>
        <?= $form->field($commentModel, 'place_id', ['template' => '{input}'])->hiddenInput(['value'=> $model->id]) ?>
        
        <?=Html::input('submit','create-comment','Отправить');?>
        
        <?php $form->end(); ?>
        <div class="clearfix"></div>
    <? endif ?>
</div>
<hr>
