<?php

use app\assets\AppAsset;
use app\assets\ForStarsAsset;
use app\models\City;
use app\models\Reviews;
use app\models\StarRating;
use app\models\StarRatingAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use app\assets\MyAsset;
use yii\helpers\Url;
use kartik\base\InputWidget;

//use kartik\widgets\StarRating

/** @var yii\web\View $this */
/** @var yii\widgets\ActiveForm $form */
/** @var app\models\reviews $model */
/** @var yii\web\View $this */
/** @var string $content */

ForStarsAsset::register($this);
MyAsset::register($this);
?>
<br>
<br>
<br>

<p class="button-da"><?= Html::a('На главную', ['site/index'], ['class' => 'btn btn-light']) ?></p>

<div class="">
    <div class="text-center">
        <img style="width: 500px;" src="<?= $city->getImage(); ?>" alt="">
    </div>


    <div class="text-center text-uppercase">
        <?= $city->name ?>
        <p>Рэйтинг просмотров:
            👁<?= $city->rating ?>
            ★<?= $five ?>
        </p>
    </div>


    <!-----------------------------------------коментрарии------------------------------------------------->
    <?php if (!empty($reviews)): ?>
        <?php foreach ($reviews as $review): ?>
            <div style="margin: 50px 0 0 32%;"><!--bottom comment-->
                <div class="text-center">
                    <img style="width: 200px;" src="<?= $review->getImage(); ?>" alt="">
                </div>
                <h4>Комментарий</h4>

                <div class="comment-text">
                    <p>Автор: <a href="#zatemnenie"><?php
                            $id = $review->id_author;
                            $model = \app\models\User::find()->where('id = :id', [':id' => $id])->one();
                            echo $model->name;
                            ?></a></p>
                    <p class="para"><?= $review->text; ?></p>
                    <p>Дата создания: <?= $review->getDate(); ?></p>

                    <!-----------------------------------------звезды------------------------------------------------->

                    <?php
                    if(is_null($review->countclick)){
                        $stars = 0;
                    }else{
                        $stars = $review->rating / $review->countclick;
                    }
                    if ($review->rating > 0) {
                        echo \kartik\rating\StarRating::widget([
                            'name' => 'rating_21',
                            'value' => $stars,
                            'pluginOptions' => [
                                'disabled' => (bool)Yii::$app->user->isGuest,//для гостя блокируем кнопки
                                'showClear' => false,
                                'showCaption' => false,
                                'min' => 0,
                                'max' => 5,
                                'step' => 1,
                                'size' => 'md',
                                'language' => 'ru',
                            ],
                            'pluginEvents' => [
                                'rating:change' => "function(event, value, caption){
      $.ajax({
      url: '/site/stars',
      method: 'post',
      data:{
      stars:value,
      id: '$review->id',
      coutClick: 1,
      },
      dataType:'json',
      success:function(data){
      //console.log(data);
      $('message').html(data);
      }
      });
      }"
                            ],
                        ]);
                    } else {
                        echo \kartik\rating\StarRating::widget([
                            'name' => 'rating_21',
                            'pluginOptions' => [
                                'disabled' => Yii::$app->user->isGuest ? true : false,//для гостя блокируем кнопки
                                'showClear' => false,
                                'showCaption' => false,
                                'min' => 0,
                                'max' => 5,
                                'step' => 1,
                                'size' => 'md',
                                'language' => 'ru',
                            ],
                            'pluginEvents' => [
                                'rating:change' => "function(event, value, caption){
      $.ajax({
      url: '/site/stars',
      method: 'post',
      data:{
      stars:value,
      id: '$review->id',
      coutClick: 1,
      },
      dataType:'json',
      success:function(data){
      //console.log(data);
      $('message').html(data);
      }
      });
      }"
                            ],
                        ]);
                    }
                    ?>


                    <!--модальное окно-->
                    <div id="zatemnenie">
                        <div id="okno">
                            <?php
                            $id = $review->id_author;
                            $model = \app\models\User::find()->where('id = :id', [':id' => $id])->one();
                            echo $model->name . " ";
                            if (!Yii::$app->user->isGuest):
                                echo $model->email . " ";
                                echo $model->date_create;
                            endif;
                            ?>
                            <a href="#" class="close">X</a>
                        </div>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>


    <!------------------------------------конец комментарии------------------------------------------------->
    <!--leave comment-->
    <?php if (!Yii::$app->user->isGuest): ?>


    <div class="leave-comment">
        <?php $form = \yii\widgets\ActiveForm::begin([
            'action' => ['site/reviews', 'id' => $city->id],
            'options' => ['class' => 'form-horizontal contact-form', 'role' => "form"]]) ?>
        <div class="form-group">
            <div class="col-md-12">
                <?= $form->field($reviewsForm, 'reviews')->textarea(['class' => 'form-control', 'placeholder' => 'Напишите комментарий'])->label(false) ?>

            </div>
        </div>
    </div>
    <button type="submit" class="btn send-btn">Опубликовать комментарий</button>
    <?php \yii\widgets\ActiveForm::end(); ?>
</div>

<?php endif; ?>
<!--end leave comment-->


</div>













