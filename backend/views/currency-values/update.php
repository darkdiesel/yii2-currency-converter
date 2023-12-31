<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\CurrencyValues $model */
/** @var array $currency_list */

$this->title = 'Update Currency Values: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Currency Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="currency-values-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'currency_list' => $currency_list,
    ]) ?>

</div>
