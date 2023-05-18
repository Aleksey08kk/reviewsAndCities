<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use app\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\City $model */
/** @var yii\widgets\ActiveForm $form */
/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function getImage(): string
    {
        return ($this->image) ? '/uploads/' . $this->image : '/no-image.png';
    }
    




    
}
