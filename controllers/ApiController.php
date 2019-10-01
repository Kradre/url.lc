<?php

namespace app\controllers;

use app\components\ControllerApi;
use app\models\forms\LinkForm;
use Yii;
use yii\filters\VerbFilter;

/**
 * ApiController implements the REST actions to use that service.
 */
class ApiController extends ControllerApi
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'add' => ['POST'],
                ],
            ],
        ];
    }

    /**
     *
     * Action to create short URL
     *
     * POST, requires only 'link' parameter in JSON format
     *
     * TODO: Make swagger for this controller
     *
     * @return array
     */
    public function actionAdd() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new LinkForm();
        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '') && $model->validate()) {
            $urlRecord = $model->createRecord(hash('sha256', time()));
            if ($urlRecord) {
                $address = $_SERVER['HTTP_HOST'] . '/' . $urlRecord->short_url;
                return ['status' => 'success', 'code' => 200, 'url' => $address];
            }
        }

        Yii::error(var_export($model->errors,true));
        Yii::$app->response->statusCode = 403;
        return ['status' => 'fail', 'code' => 403];
    }
}
