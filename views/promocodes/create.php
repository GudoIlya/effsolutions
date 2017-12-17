<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Promocodes */

$this->title = 'Create Promocodes';
$this->params['breadcrumbs'][] = ['label' => 'Promocodes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promocodes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
