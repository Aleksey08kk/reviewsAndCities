<?php

require_once "foundByIp.php";
session_start();

use app\assets\MyAsset;
use app\models\StarRating;
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;
use yii\web\JsExpression;

/** @var yii\web\View $this */
/** @var string $content */

MyAsset::register($this);
AppAsset::register($this);

$this->title = 'reviews and cities';
?>

<div class="site-index">
    <div class="body-content">

        <!-------------------------------------------- ижевск ваш город? -------------------------------------------------->
        <div class="wrap-found-by-ip">
            <p class="your-city">Ваш город</p>
            <?= /** @var TYPE_NAME $result */
            $result->city ?>
            <p>? - </p>
            <p class="button-da"><?= Html::a('Да.', ['site/my-city'], ['class' => 'btn btn-light']) ?></p>
            <p class="button-da"><?= Html::a('Изменить∨', ['#zatemnenie'], ['class' => 'btn btn-light']) ?></p>
        </div>
 <!------------------------------------------------------------------------------------------------------------------->

 <!-----------------------------------------------Вывод названий городов--------------------------------------------->
        <div id="zatemnenie">
            <div id="okno">
                <aside class="widget border pos-padding">
                    <ul class="ul-city-sort-in-modal">
                        <?php /** @var TYPE_NAME $citySortAbc */
                        foreach ($citySortAbc as $city): ?>
                            <li>
                                <p class="rating">
                                <a class="a-city-sort-in-modal"
                                   href="<?= Url::toRoute(['site/view2', 'id' => $city->id]); ?>"><?= $city->name ?></a>
                                       ★<?=$city->rating ?>
                                </p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </aside>
                <a href="#" class="close">X</a>
            </div>
        </div>
        <!---------------------------------------------------------------------------------------------------------------->


        <div class="jumbotron text-center main-1">
            <h1 class="display-4">ReviewsAndCities</h1>
        </div>



    </div>
</div>