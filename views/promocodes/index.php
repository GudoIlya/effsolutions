<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PromocodesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Промокоды';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promocodes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать промокод', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            
            'begin_date',
            'end_date',
            'compensation',
            [
                'attribute'=>'city_id',
                'value'=>'city.city_name',
            ],
            [
                'attribute' => 'status',
                
            ],
            //'status',
            //'promocode',            

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {link} {activate}',
                'buttons' => [
                    'link' => function($url, $model, $key) {
                        return Html::a('Инфо', ['api/promocode/get-discount-info', 'promocode_name' => $model->promocode, 'token' => Yii::$app->getRequest()->getCsrfToken()]);
                    },
                    'activate' => function($url, $model, $key) {
                        return Html::a('Активировать', ['api/promocode/activate-discount', 'promocode_name' => $model->promocode,'city_id' => $model->city_id, 'token' => Yii::$app->getRequest()->getCsrfToken()]);
                    }
                ]
            ],
        ],
    ]); ?>
</div>
