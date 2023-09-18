<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\CurrencyValues $model */

$this->title = 'Create Currency Values';
$this->params['breadcrumbs'][] = ['label' => 'Currency Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currency-values-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
