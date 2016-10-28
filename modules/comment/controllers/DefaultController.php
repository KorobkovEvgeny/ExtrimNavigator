<?php

namespace app\modules\comment\controllers;

use Yii;
use app\modules\comment\models\Comment;
use app\modules\comment\models\CommentSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for Comment model.
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Функция ограничения контроля к действиям контроллера
     * @param \yii\base\Action $action
     * @return bool|\yii\web\Response
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        /*echo "<pre>";
        var_dump($action);
        echo "</pre>";
        exit();
        if ($action == 'update') {
            return parent::beforeAction($action);
        }*/
        if (Yii::$app->user->identity->isAdmin() || $action->id == 'update') {
            return parent::beforeAction($action);
        } else {
            return $this->goHome();
        }
    }

    /**
     * Lists all Comment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CommentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Comment model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Comment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Comment();
        $model->author_id = Yii::$app->user->identity->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            return $this->goHome();
        }
    }

    /**
     * Updates an existing Comment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->identity->isAdmin() || $this->findModel($id)->IsAuthor())
        {
            $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect([Url::previous()]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }else {
            return $this->goHome();
        }
    }

    /**
     * Deletes an existing Comment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->identity->isAdmin() || $this->findModel($id)->IsAuthor())
        {
            $this->findModel($id)->delete();
            return $this->redirect([Url::previous()]);
        }else {
            return $this->goHome();
        }
    }

    /**
     * Finds the Comment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
