<?php

use app\modules\category\models\Category;
use app\modules\city\models\City;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\main\models\SearchModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="main-default-search">
    <?php $form = ActiveForm::begin([
        'action' => Url::to(['/']),
        'method' => 'get',
        'options' => ['class' => 'form-inline form-group form-group-sm col-xs-12'],
        'fieldConfig' => [
            'template' => "{input}",
        ],
    ]); ?>
</div>
<div class="row">
    <div
        class='col-md-3'><?= $form->field($model, 'city_id')->dropDownList(ArrayHelper::map(City::find()->all(), 'id', 'name_city'), ['prompt' => Yii::t('yii', 'Все города')]) ?>  </div>
    <div
        class='col-md-3'><?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Category::find()->all(), 'id', 'name_category'), ['prompt' => Yii::t('yii', 'Все категории')]) ?>  </div>
    <div class='col-md-3'><?= $form->field($model, 'date_from')->widget(DatePicker::classname(), [
            'model' => $model,
            'attribute' => 'date_from',
            'attribute2' => 'date_to',
            'options' => ['placeholder' => 'Начальная дата'],
            'options2' => ['placeholder' => 'Конечная дата'],
            'type' => DatePicker::TYPE_RANGE,
            'separator' => '-',
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'autoclose' => true,
            ]
        ]) ?>
    </div>
    <?= Html::submitButton(Yii::t('app', 'Искать'), ['class' => 'btn btn-warning']) ?>
</div>
<?php ActiveForm::end(); ?>
