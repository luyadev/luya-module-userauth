<?php

namespace luya\userauth\frontend\controllers;

use Yii;
use luya\web\Controller;

/**
 * Logout Controller.
 *
 * @author Basil Suter <basil@nadar.io
 * @since 1.0.0
 */
class LogoutController extends Controller
{
    /**
     * Ensure logout and redirect to home page.
     *
     * @return \yii\web\Response|string
     */
    public function actionIndex()
    {
        Yii::$app->user->logout();
        
        return $this->goHome();
    }
}
