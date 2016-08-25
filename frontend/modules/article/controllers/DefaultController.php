<?php

namespace app\modules\article\controllers;

use common\models\ArticleCategory;
use common\models\Blog;
use yii\base\Module;
use yii\web\Controller;
use common\models\Article;
use Yii;
use yii\data\Pagination;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use common\models\Comment;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use common\models\ArticleSearch;
use vova07\imperavi\actions\GetAction;
use yii\web\Response;


class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'delete', 'create-image', 'parser-start', 'image-submit','create', 'show', 'image-upload', 'images-get', 'upload','uploaded','view'],
                        'allow' => true,
                        'roles' => ['@','?'],
                    ],
                    [
                        //'actions' => ['index', 'view', 'show', 'views', 'add-news-from-parser'],
                        //'allow' => true,
                        //'roles' => ['@', '?'],
                    ],
                ],
            ],
        ];
    }

    public $layout = 'admin';
    public $meta = [];
    public $countallArticles = 0;
    public $uploudPath = '/web/upload/article';

    public function actions()
    {
        return [
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url' => '/frontend/web/upload/article/', // URL адрес папки куда будут загружатся изображения.
                //'path' => Yii::getAlias('@frontend') . '/web/upload/imp' // Или абсолютный путь к папке куда будут загружатся изображения.
            ],
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetAction',
                'url' => '/frontend/web/upload/article', // URL адрес папки куда будут загружатся изображения.
                //'path' => Yii::getAlias('@frontend') . '/web/upload/imp', // Или абсолютный путь к папке куда будут загружатся изображения.
                'type' => GetAction::TYPE_IMAGES,
            ]
        ];
    }

    public function actionIndex()
    {

        $catID = Yii::$app->request->get('category');

        // Вывести список статей
        $pageSize = 9;
        $query = Article::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => $pageSize]);

        if ($catID) {
            $models = $query->offset($pages->offset)
                ->where(['article_category' => $catID])
                ->orderBy('created_at DESC')
                ->limit($pages->limit)
                ->all();
        } else {
            $models = $query->offset($pages->offset)
                ->orderBy('created_at DESC')
                ->limit($pages->limit)
                ->all();
        }


        $modelLastArticle = Article::find()
            ->orderBy('id DESC')
            ->limit(3)
            ->all();

        $modeMostWatched = Article::find()
            ->orderBy('view DESC')
            ->limit(3)
            ->all();


        $ArticleCategoryModel = ArticleCategory::find()
            ->leftJoin('article', '`article`.`article_category` = `article_category`.`id`')
            ->where(['<>', 'article.article_category', 111])
            ->with('article')
            ->all();


        return $this->render('index', ['model' => $models,
            'modelLastArticle' => $modelLastArticle,
            'modeMostWatched' => $modeMostWatched,
            'pages' => $pages,
            'pageSize' => $pageSize,
            'ArticleCategoryModel' => $ArticleCategoryModel
        ]);
    }

    public function actionView()
    {
        $this->layout = 'admin';
        $id = Yii::$app->request->get('id');
        $Article = $this->findModel($id);
        //$Article = Article::find()->where(['id' => $id])->one();
        return $this->render('view', ['model' => $Article]);
    }

    public function actionShow()
    {


        $this->layout = 'admin';

        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $this->countallArticles = Article::find()->count();
        return $this->render('show', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'countallArticles' => $this->countallArticles
        ]);
    }

    public function actionCreate()
    {
        $this->layout = 'admin';
        $model = new Article();

        $this->countallArticles = Article::find()->count();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $this->layout = 'admin';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['show']);
    }

    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCreateImage()
    {
        FileHelper::createDirectory(Yii::getAlias('@frontend') . '/web/upload/article');
        $model = new Blog();
        $name = date("dmYHis", time());
        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->file->saveAs('upload/blog/' . $name . '.' . $model->file->extension);
            $full_name = $name . '.' . $model->file->extension;
            return '/upload/article/' . $full_name;
        }
    }

    public function actionViews()
    {

        //$this->title = 'Заголовок, сгенерированный контроллером';

        $this->layout = 'admin';

        //$id = Yii::$app->request->get('id');
        $slug = Yii::$app->request->get('slug');
        //vd($slug);
        $Article = Article::find()->where(['slug' => $slug])->one();
        if ($Article) {
            $viwsQuantity = (int)$Article->view;
            $Article->view = $viwsQuantity + 1;
            $Article->updateAttributes(['view']);
            $coment_model = Comment::find()->where(['blog_id' => $Article->id])->all();

            $this->meta = $Article;
            return $this->render('views', ['model' => $Article, 'coment_model' => $coment_model]);
        } else {
            return $this->redirect('/site/index');
        }
    }


    public function actionImageSubmit()
    {
        FileHelper::createDirectory(Yii::getAlias('@frontend') . $this->uploudPath);
        $path = Yii::getAlias('@frontend') . $this->uploudPath . '/';

        $model = new Article();
        $name = date("dmYHis", time());
        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->file->saveAs($path . $name . '.' . $model->file->extension);
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $name . '.' . $model->file->extension;
        }
    }


    // Вернет только что загруженное фото
    public function actionUpload()
    {
        $uploaddir = Yii::getAlias('@frontend') . '/web/upload/article/';
        $file = md5(date('YmdHis')) . '.' . pathinfo(@$_FILES['file']['name'], PATHINFO_EXTENSION);
        if (move_uploaded_file(@$_FILES['file']['tmp_name'], $uploaddir . $file)) {
            $array = array(
                'filelink' => '/upload/article/' . $file
            );
        }
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $array;
    }


    // Вернет уже загруженные файлы
    public function actionUploaded()
    {

        $uploaddir = Yii::getAlias('@frontend') . '/web/upload/article';
        $arr = scandir($uploaddir);
        $i = 0;
        foreach ($arr as $key => $val) {
            $i++;
            if ($i > 2) {
                $array['filelink' . $i]['thumb'] = '/upload/article/' . $val;
                $array['filelink' . $i]['image'] = '/upload/article/' . $val;
                $array['filelink' . $i]['title'] = '/upload/article/' . $val;
            }
        }
        $array = stripslashes(json_encode($array));
        echo $array;
    }
}
