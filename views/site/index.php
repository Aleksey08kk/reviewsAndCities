<?php
require_once "foundByIp.php";

use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var string $content */

$this->title = 'reviews and cities';
?>

<div class="site-index" >
<div class="body-content">
    <!-------------------------------------------- ижевск ваш город? -------------------------------------------------->

    <div class="wrap-found-by-ip">
        <p class="your-city">Ваш город</p>
        <div id="user-city"></div>
        <p>? - </p>
        <a class="link" href="<?= Url::toRoute(['site/view', 'id' => $city->id]); ?>">
            <p class="col">Да</p>
        </a>
    </div>


    <!-------------------------------------------- конец ижевск ваш город? -------------------------------------------->
    <!-----------------------------------------------Вывод названий городов----------------------начало----------------------->
    <aside class="widget border pos-padding">
        <h3 class="text-center">Если нет, выберете город из списка: </h3>
        <ul>
        <?php sort($city); ?> <!--не работает!-->
            <?php foreach ($city as $city): ?>
            <li>
                <a href="<?= Url::toRoute(['site/view', 'id' => $city->id]); ?>"><?=$city->name?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </aside>
            
    
    <!-------------------------------------------------------------Конец--------------------------------------------------->
    <div class="jumbotron text-center">
        <h1 class="display-4">ReviewsAndCities</h1>
    </div>

</div>
</div>