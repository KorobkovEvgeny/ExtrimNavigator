<?php

namespace app\modules\main\controllers;

use app\modules\main\models\SearchModel;
use yii\web\Controller;
use yii;

/**
 * Контроллер по умолчанию для модуля "main"
 */
class DefaultController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Действие Index (по умолчанию)
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Действие About
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
