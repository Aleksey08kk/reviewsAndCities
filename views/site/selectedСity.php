<?php

use app\assets\AppAsset;
use app\models\City;
use app\models\Reviews;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use app\assets\MyAsset;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var yii\widgets\ActiveForm $form */
/** @var app\models\reviews $model */
/** @var yii\web\View $this */
/** @var string $content */

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

    <article class="post">
        <div class="text-center text-uppercase">
            <?= $city->name ?>
        </div>
    </article>
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
