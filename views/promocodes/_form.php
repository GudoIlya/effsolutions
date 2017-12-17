<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
use app\models\Cities;

/* @var $this yii\web\View */
/* @var $model app\models\Promocodes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="promocodes-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'begin_date')
    ->widget(DatePicker::classname(), ['language'=>'ru', 'dateFormat' => 'php:d.m.Y', 'options'=>['class'=>'form-control', 'disabled' => !$model->isNewRecord && $model->status == '0' ? 'disabled' : false] ])
    ->label('Начало действия'); ?>  
    
    <?= $form->field($model, 'end_date')
    ->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'php:d.m.Y',
    'options' => ['class'=> 'form-control', 'disabled' => !$model->isNewRecord && $model->status == '0' ? 'disabled' : false]])
    ->label('Окончание действия'); ?>

    <?= $form->field($model, 'city_id')
    ->dropDownList(ArrayHelper::map(Cities::find()->all(), 'id', 'city_name'),['disabled' => !$model->isNewRecord && $model->status == '0' ? 'disabled' : false])
    ->label('Зона действия'); ?>
    
    <?= $form->field($model, 'promocode')->textInput(['maxlength' => true, 'disabled' => !$model->isNewRecord && $model->status == '0' ? 'disabled' : false])->label('Название промокода') ?>
    
    <?= $form->field($model, 'compensation')->textInput(['maxlength' => true, 'disabled' => !$model->isNewRecord && $model->status == '0' ? 'disabled' : false])->label('Величина компенсации'); ?>

    <?= !$model->isNewRecord ? $form->field($model, 'status')->radioList($model->getStatus()) : "" ; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
