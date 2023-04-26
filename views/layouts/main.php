<?php

/** @var yii\web\View $this */

/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <nav class="d-flex">
        <a class="link" href="/">ReviewsAndCities</a>
        <div class="d-flex headermenu" id="bs-example-navbar-collapse-1">
            <ul class="headerlist d-flex container px-4">
                <?php if (Yii::$app->user->isGuest): ?>
                    <li class="item">
                        <a class="link" href="<?= Url::toRoute(['auth/login']) ?>">Войти</a>
                    </li>
                    <li class="item">
                        <a class="link" href="<?= Url::toRoute(['auth/signup']) ?>">Регистрация</a>
                    </li>
                <?php else: ?>
                    <li class="item3admins">
                        <a class="link" href="<?= Url::toRoute(['/admin']) ?>">Редактировать города</a>
                    </li>
                    <?= Html::beginForm(['/auth/logout'], 'post') . Html::submitButton('Logout (' . Yii::$app->user->identity->name . ')', ['class' => 'btnlogout']) . Html::endForm() ?>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>


<?= $content ?>


<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; Отзывы и города <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
