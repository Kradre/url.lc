<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UrlContainer */

$this->title = 'Update Url Container: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Url Containers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="url-container-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
