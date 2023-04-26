<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\LoginForm */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="form">
    <h1 class="labelAuthorization"><?= Html::encode($this->title) ?></h1>

    <p class="labelAuthorization">Заполните поля для входа в систему:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => ''],
        ],
    ]); ?>
    <div class="input">
        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>
    </div>
    <?= Html::submitButton('Войти', ['class' => 'buttonAuthorization', 'name' => 'login-button']) ?>

    <?php ActiveForm::end(); ?>

</div>

