<?php

namespace app\controllers;

use app\models\ImageUpLoad;
use app\models\ReviewsForm;
use app\models\UploadForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\City;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $city = City::find()->all();  //выводит все города
        return $this->render('index', [
            'city' => $city,
        ]);
    }
    public function actionView($id)
    {
        $city = City::findOne($id);
        $reviews = $city->reviews;
        $reviewsForm = new ReviewsForm();


        return $this->render('selectedСity', [
            'city' => $city,
            'reviews' => $reviews,
            'reviewsForm' => $reviewsForm,
        ]);
    }

    public function actionSelectedCity()
    {
        return $this->render('selectedСity');
    }


    public function actionReviews(int $id): Response
    {
        $model = new ReviewsForm();
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            if ($model->saveReviews($id)) {
                Yii::$app->getSession()->setFlash('reviews', 'Ваш отзыв добавился!');
            }
        }return $this->redirect(['site/views', 'id' => $id]);
    }

    public function actionSetImage(int $id)
    {
        $model = new ImageUpLoad;

        if (Yii::$app->request->isPost) {
            $city = $this->findModel($id);
            $file = UploadedFile::getInstance($model, 'image');

            if ($city->saveImage($model->uploadFile($file, $city->image))) {
                return $this->redirect(['view', 'id' => $city->id]);
            }
        }
        return $this->render('image', ['model' => $model]);
    }


}
