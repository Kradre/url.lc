<?php

use \yii\widgets\ActiveForm;
use \yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\LinkForm */

$this->title = 'url.lc';
?>
<div class="site-index">
    <?php $form = ActiveForm::begin() ?>
    <?= $form->field($model, 'link')->textInput() ?>
    <div class="col-md-12 form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'submitButton']) ?>
    </div>
    <?php ActiveForm::end() ?>
</div>
