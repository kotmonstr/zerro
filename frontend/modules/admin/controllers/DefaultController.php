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

/**
 * Default controller for the `home` module
 */
class DefaultController extends Controller
{
    public  $layout = 'admin';


    public function actionIndex()
    {
        return $this->render('index');
    }

}


