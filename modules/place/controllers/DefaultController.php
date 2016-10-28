<?php

namespace app\modules\place\controllers;

use app\modules\city\models\City;
use app\modules\comment\models\Comment;
use Yii;
use app\models\Photo;
use app\modules\place\models\Place;
use app\modules\place\models\PlaceSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * DefaultController implements the CRUD actions for Place model.
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'view','test'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Place models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PlaceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Place model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'comments' => Comment::find()->where(['place_id' => $this->findModel($id)->id]),
            'comment' => new Comment(),
        ]);
    }

    /**
     * Creates a new Place model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Place();
        $model->author_id = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->file = UploadedFile::getInstances($model, 'file');
            $folder = $model->getFolderPhoto();
            foreach ($model->file as $file) {
                $photo = new Photo();
                $filename = $photo->getName($file->baseName) . '.' . $file->extension;
                if ($file->saveAs($folder . $filename)) {
                    $photo->place_id = $model->id;
                    $photo->filename = $filename;
                    $photo->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,

            ]);
        }
    }

    /**
     * Updates an existing Place model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $photoDelete = Photo::find()->where(['place_id' => $model->id])->all();
        $model->city_id = City::findOne(['id' => $model->city_id])->name_city;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->file = UploadedFile::getInstances($model, 'file');
            $folder = $model->getFolderPhoto();
            foreach ($model->file as $file) {
                $photo = new Photo();
                $filename = $photo->getName($file->baseName) . '.' . $file->extension;
                if ($file->saveAs($folder . $filename)) {
                    $photo->place_id = $model->id;
                    $photo->filename = $filename;
                    $photo->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'photo' => $photoDelete,
            ]);
        }
    }

    /**
     * Deletes an existing Place model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        Place::delImagesFile($id);
        $this->findModel($id)->delete();
        return $this->redirect(['/']);
    }

    /**
     * Finds the Place model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Place the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
//Удаление фотографий, на имя actionPhotoDelete ругался yii
    public function actionTest($id)
    {
        $photo = Photo::findOne($id);
        $model = $this->findModel($photo->place_id);
        $photo->delete();
        $photoDelete = Photo::find()->where(['place_id' => $model->id])->all();
        return $this->render('update', [
            'model' => $model,
            'photo' => $photoDelete,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Place::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
