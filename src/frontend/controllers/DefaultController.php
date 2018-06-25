<?php

namespace luya\userauth\frontend\controllers;

use Yii;
use luya\web\Controller;
use luya\userauth\models\UserLoginForm;

/**
 * User Login.
 * 
 * @author Basil Suter <basil@nadar.io
 * @since 1.0.0
 */
class DefaultController extends Controller
{
    /**
     * Render the login form model.
     * 
     * @return \yii\web\Response|string
     */
    public function actionIndex()
    {
        $model = new UserLoginForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->validate() && Yii::$app->user->login($model->user)) {
            return $this->redirect(Yii::$app->user->returnUrl);
        }
        
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}