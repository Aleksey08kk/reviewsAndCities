<?php

namespace app\controllers;

use app\models\ImageUpLoad;
use app\models\ReviewsForm;
use app\models\SaveCity;
use Yii;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\City;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\AccountActivation;

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
        $citySortAbc = City::find()->orderby(['name' => SORT_ASC])->all(); //сортировка по алфавиту
        $city = City::find()->all();  //выводит все города
        return $this->render('index', [
            'city' => $city,
            'citySortAbc' => $citySortAbc,
        ]);
    }

    public function actionView($id)
    {
        $citySortAbc = City::find()->orderby(['name' => SORT_ASC])->all(); //сортировка по алфавиту
        $city = City::findOne($id);
        $reviews = $city->reviews;
        $reviewsForm = new ReviewsForm();

        return $this->render('selectedСity', [
            'city' => $city,
            'reviews' => $reviews,
            'reviewsForm' => $reviewsForm,
            'citySortAbc' => $citySortAbc,
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
        }
        return $this->redirect(['site/selectedCity', 'id' => $id]);
    }


    public function actionOurCity()
    {
        $arrayOurCityByIp = (Yii::$app->request->post()); //запрос в наш сервер в экшен site/our-city. ajax запрос из FoundByIp.php
        $cityFromArrayByIp = $arrayOurCityByIp["city"]; //запись города в переменую.

        $getIdByName = City::find()->where('name = :name', [':name' => $cityFromArrayByIp])->one(); //поиск имени в базе и вывод его id

        if ($getIdByName) {
            return $this->redirect(['site/view', 'id' => $getIdByName->id]);  //если в базе есть, передаем id и открываем в selectedCity
        } else {
            $customer = new City();
            $customer->name = $cityFromArrayByIp;
            $customer->save();                                  //если в базе нет, сохраняем в базу
                return $this->redirect(['site/view', 'id' => $getIdByName->id]);
        }
    }



}




