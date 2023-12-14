<?php

namespace luya\userauth\frontend\controllers;

use luya\web\Controller;
use Yii;
use yii\filters\HttpCache;

/**
 * Logout Controller.
 *
 * @author Basil Suter <basil@nadar.io
 * @since 1.0.0
 */
class LogoutController extends Controller
{
    /**
     * {@inheritDoc}
     */
    public function behaviors()
    {
        return [
            'httpCache' => [
                'class' => HttpCache::class,
                'cacheControlHeader' => 'no-store, no-cache',
                'lastModified' => function ($action, $params) {
                    return time();
                },
            ],
        ];
    }

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
