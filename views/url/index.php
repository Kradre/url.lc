<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UrlSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Url Containers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="url-container-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create short url ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'short_url',
                'format' => 'url',
                'value' => function ($data) {
                    /** @var \app\models\UrlContainer $data */
                    return $_SERVER['HTTP_HOST'] . "/" . $data->short_url;
                },
            ],
            'full_url:url',
            [
                'attribute' => 'created_at',
                'value' => function ($data) {
                    /** @var \app\models\UrlContainer $data */
                    return date('d-m-Y',$data->created_at);
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
            ],
        ],
    ]); ?>


</div>
