<?php

namespace app\controllers;

use app\models\LinkForm;
use app\models\UrlContainer;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Inflector;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        $actions = $this->getAllControllerActions();

        if ($action->id == 'index') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    public function actionRedirect($slug)
    {

        /** @var UrlContainer $urlData */
        $urlData = UrlContainer::find()->where(['short_url' => $slug])->one();
        if (!empty($urlData)) {
            return $this->redirect($urlData->full_url);
        }
        return $this->goHome();
    }

    /**
     * Displays homepage and form to create record.
     *
     * @return string
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;

        if (!$session->has('auth_key')) {
            $session->set('auth_key', hash('sha256', time()));
        }

        $model = new LinkForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            /** @var UrlContainer $urlRecord */
            $urlRecord = $model->createRecord($session->get('auth_key'));
            if ($urlRecord) {
                Yii::$app->session->setFlash('success',
                    'Your short url: ' . Yii::$app->params['urlShort'] . '/' . $urlRecord->short_url
                );
            } else {
                Yii::$app->session->setFlash('error',
                    'Something went wrong. The information was sent to administrator.'
                );
            }
        }

        return $this->render('index', [
            'model' => $model
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    /**
     * Function to check all actions of controller.
     * Required for short links
     * @return array
     */
    public function getAllControllerActions()
    {
        $controllers = \yii\helpers\FileHelper::findFiles(Yii::getAlias('@app/controllers'), ['recursive' => true]);
        $actions = [];
        foreach ($controllers as $controller) {
            $contents = file_get_contents($controller);
            $controllerId = Inflector::camel2id(substr(basename($controller), 0, -14));
            preg_match_all('/public function action(\w+?)\(/', $contents, $result);
            foreach ($result[1] as $action) {
                $actionId = Inflector::camel2id($action);
                $route = $controllerId . '/' . $actionId;
                $actions[$route] = $route;
            }
        }
        asort($actions);
        $actions[] = 'gii';
        return $actions;
    }

}
