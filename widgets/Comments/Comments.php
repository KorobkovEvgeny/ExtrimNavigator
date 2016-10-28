<?php

namespace app\widgets\Comments;


use app\modules\comment\models\Comment;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\data\ActiveDataProvider;


class Comments extends Widget
{
    /**
     * @var $model app\modules\place\models\Place
     */
    public $model;



    /**
     * @var string comment form id
     */
    public $formId = 'comment-form';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if ($this->model === null) {
            throw new InvalidConfigException(Yii::t('app', 'The "model" property must be set.'));
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $comments = $this->model->getComments();
        $dataProvider = new ActiveDataProvider([
            'query' => Comment::find()->with(['author', 'place'])->where(['place_id' => $this->model->id])->orderBy('created_at DESC'),
            'pagination' => false,
        ]);
        return $this->render('index', [
            'model' => $this->model,
            'comments' => $comments,
            'commentModel' => new Comment(),
            'dataProvider' => $dataProvider,
        ]);
    }

}