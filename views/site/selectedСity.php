<?php

use app\assets\AppAsset;
use yii\helpers\Url;

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
    <?php if (!empty($comments)): ?>
        <?php foreach ($comments as $comment): ?>
            <div class="bottom-comment"><!--bottom comment-->
                <h4>Комментарий</h4>

                <div class="comment-img">
                    <img class="img-circle" src="/public/images/comment-img.jpg" alt="">
                </div>

                <div class="comment-text">
                    <h5><?= $reviews->title; ?></h5>
                    <p class="comment-date"><?= $reviews->getDate(); ?></p>
                    <p class="para"><?= $reviews->text; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <!-- end bottom comment-->

    <!--leave comment-->
    <?php if (!Yii::$app->user->isGuest): ?>

        <div class="leave-comment">

            <?php if (Yii::$app->session->getFlash('comment')): ?>
                <div class="alert alert-success" role="alert">
                    <?= Yii::$app->session->getFlash('comment'); ?>
                </div>
            <?php endif; ?>

            <?php $form = \yii\widgets\ActiveForm::begin([
                'action' => ['site/comment', 'id' => $article->id],
                'options' => ['class' => 'form-horizontal contact-form', 'role' => "form"]]) ?>
            <div class="form-group">
                <div class="col-md-12">
                    <?= $form->field($commentForm, 'comment')->textarea(['class' => 'form-control', 'placeholder' => 'Напишите комментарий'])->label(false) ?>
                </div>
            </div>
            <button type="submit" class="btn send-btn">Опубликовать комментарий</button>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>

    <?php endif; ?>
<!------------------------------------конец комментарии------------------------------------------------->

</div>
