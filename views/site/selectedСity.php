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


<!------------------------------------конец комментарии------------------------------------------------->

</div>
