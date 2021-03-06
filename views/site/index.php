<?php

use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
use \yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model \app\models\LinkForm */
/* @var $searchModel app\models\search\UrlSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Short links creator';
?>
<div class="site-index col-md-push-4 col-md-4 text-center">
    <?php $form = ActiveForm::begin() ?>
    <?= $form->field($model, 'link')->textInput() ?>
    <div class="col-md-12 form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary btn-lg', 'name' => 'submitButton']) ?>
    </div>
    <?php ActiveForm::end() ?>
</div>
