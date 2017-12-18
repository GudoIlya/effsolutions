<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PromocodesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Promocodes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promocodes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Promocodes', ['create'], ['class' => 'btn btn-success']) ?>
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
            'status',
            //'promocode',            

            ['class' => 'yii\grid\ActionColumn'],
            ],
    ]); ?>
</div>
