<?php

namespace app\components;

use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;
use yii\web\Response;

/**
 * Class ApiController
 * Extension for api
 *
 * @package api\components
 */
class ControllerApi extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\ContentNegotiator',
                'formats' => ['application/json' => Response::FORMAT_JSON],
            ],
        ];
    }
}
