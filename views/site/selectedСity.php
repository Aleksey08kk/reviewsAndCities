<?php

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\City $model */
/** @var yii\widgets\ActiveForm $form */

AppAsset::register($this);
?>
<br>
<br>
<br>

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
                    <h5 class="px20">Название отзыва: <?= $review->title; ?></h5>
                    <p class="para">Текст отзыва: <?= $review->text; ?></p>
                    <h5>И автора: <?= $review->id_author;?></h5>
                    <p>Дата создания: <?= $review->getDate();?></p>
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
            <button type="submit" class="btn send-btn">Опубликовать комментарий</button>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>

    <?php endif; ?>
    <!--end leave comment-->







</div>
