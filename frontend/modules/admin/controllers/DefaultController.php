<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Article;

/**
 * Default controller for the `home` module
 */
class DefaultController extends Controller
{
    public $layout = 'admin';
    public $countallArticles = 0;


    public function actionIndex()
    {
        $this->countallArticles = Article::find()->count();
        return $this->render('index');
    }

}


