<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UrlContainer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="url-container-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'short_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'full_url')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
