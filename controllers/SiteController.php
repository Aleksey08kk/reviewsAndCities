<?php

namespace app\controllers;

use app\models\ImageUpLoad;
use app\models\Reviews;
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
    public function actionIndex(): string
    {
        $citySortAbc = City::find()->orderby(['name' => SORT_ASC])->all(); //сортировка по алфавиту
        return $this->render('index', [
            'citySortAbc' => $citySortAbc,
        ]);
    }

    public function actionView($id): string
    {
        $citySortAbc = City::find()->orderby(['name' => SORT_ASC])->all();
        $city = City::findOne($id);
        $reviews = $city->reviews;
        $reviewsForm = new ReviewsForm();
        $city->viewedCounter();
        $five = $city->fivePoint($id);


        if (isset($_SESSION['city_session'])) {
            return $this->render('selectedСity', [
                'city' => $city,
                'reviews' => $reviews,
                'reviewsForm' => $reviewsForm,
                'citySortAbc' => $citySortAbc,
                'five' => $five,
            ]);
        } else {
            return $this->render('index', [
                'city' => $city,
                'citySortAbc' => $citySortAbc,
            ]);
        }
    }

    public function actionView2($id): string
    {
        $citySortAbc = City::find()->orderby(['name' => SORT_ASC])->all();
        $city = City::findOne($id);
        $reviews = $city->reviews;
        $reviewsForm = new ReviewsForm();
        $city->viewedCounter();
        $five = $city->fivePoint($id);

        return $this->render('selectedСity', [
            'city' => $city,
            'reviews' => $reviews,
            'reviewsForm' => $reviewsForm,
            'citySortAbc' => $citySortAbc,
            'five' => $five,
        ]);
    }

    public function actionSelectedCity($id): string
    {
        $citySortAbc = City::find()->orderby(['name' => SORT_ASC])->all();
        $city = City::findOne($id);
        $reviews = $city->reviews;
        $reviewsForm = new ReviewsForm();
        $city->viewedCounter();

        return $this->render('selectedСity', [
            'city' => $city,
            'reviews' => $reviews,
            'reviewsForm' => $reviewsForm,
            'citySortAbc' => $citySortAbc,
        ]);
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
        return $this->redirect(['site/view', 'id' => $id]);
    }


    public function actionMyCity(): Response
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        $result = json_decode($result);
        if ($result->status == 'success') {
            $getIdByName = City::find()->where('name = :name', [':name' => $result->city])->one();  //поиск имени в базе и вывод его id

            $session = Yii::$app->session;
            $session->set('city_session', $getIdByName['name']);
            Yii::$app->session->setTimeout(5); //5 секунд для проверок
        }
        return $this->redirect(['site/view', 'id' => $getIdByName['id']]);
    }

    public function actionStars()
    {
        $model = Reviews::find()->where(['id' => $_POST['id']])->one(); //находим нужный отзыв/комментарий в базе по id
        $oldCountClick = $model->countclick; //Берем имеющуюся запись количества кликов
        $model->countclick = $_POST['coutClick'] + $oldCountClick; //новый клик складываем со имеющейся и сохраняем
        $model->save();
        if ($model->save()) {

            $forResult = Reviews::find()->where('id = :id', [':id' => $_POST['id']])->one();
            $star = $forResult->rating; //имеющаяся оценка из базы
            $countClickActual = $forResult->countclick; //имеющиеся клики


            if (!empty($model)) {
                $model->rating = ($_POST['stars'] + $star); //оценка из базы + новая. чтоб не делить на 0 делаем else
                $model->save();
            } else {
                $model->rating = ($_POST['stars'] + $star) / $countClickActual; //оценка из базы + новая / количество кликов
                $model->save();
            }

        }return true;
    }


}





