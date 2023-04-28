<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\reviews $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="city-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'image')->fileInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
