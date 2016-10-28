<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\comment\models\Comment */

$this->title = Yii::t('app', 'Редактирование {modelClass}: ', [
    'modelClass' => 'комментария',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Комментарии'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактировать');
?>
<div class="comment-default-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
