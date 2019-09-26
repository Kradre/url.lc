<?php

namespace app\controllers;

use app\models\forms\LinkForm;
use app\models\search\UrlSearch;
use app\models\UrlContainer;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\forms\LoginForm;

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
        /** Anonymous user ID (TODO: Auth by this ID) */

        $session = Yii::$app->session;

        if (!$session->has('auth_key')) {
            $session->set('auth_key', hash('sha256', time()));
        }

        return parent::beforeAction($action);
    }

    /**
     * Action for redirect on short links
     *
     * @param $slug
     * @return Response
     */
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

        $searchModel = new UrlSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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


}
