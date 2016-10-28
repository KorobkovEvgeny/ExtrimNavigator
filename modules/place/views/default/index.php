<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\place\models\PlaceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Places');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="place-default-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php /*echo $this->render('_search', ['model' => $searchModel]); */ ?>
    <p>
        <?= Html::a(Yii::t('app', 'Create Place'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'description:ntext',
            [
                //'filter' => User::getStatusesArray(),
                'attribute' => 'author_id',
                //'value' => 'author',
            ],
            'category_id',
            // 'city_id',
            // 'coordinates',
            // 'rating',
            // 'created_at',
            // 'updated_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
