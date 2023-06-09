<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var string $content */

$this->title = 'reviews and cities';
?>

<!-------------------------------------------- ижевск ваш город? -------------------------------------------------->
<script src="http://yastatic.net/jquery/2.1.1/jquery.min.js"></script>
<script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>
<script type="text/javascript">
    window.onload = function () {
        $.get("http://ip-api.com/json", function (data) {  //запрос во внешний апи
            console.log(data);
            $("#user-city").text(data.city);

            $.ajax({                //запрос в наш сервер в экшен site/our-city
                url: 'site/get-city-by-ip',
                method: 'post',
                dataType: 'html',
                data: data,
                success: function (data) {
                    $('message').html(data);
                }
            });
        });
    }

</script>


    <div class="wrap-found-by-ip">
        <p class="your-city">Ваш город</p>
        <div id="user-city"></div>
        <p>? - </p>
        <a class="link" href="<?= Url::toRoute(['site/view', 'id' => $city->id]); ?>">
            <p class="col">Да</p>
        </a>
    </div>
<!-------------------------------------------- конец ижевск ваш город? -------------------------------------------->

