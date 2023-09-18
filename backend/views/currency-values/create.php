<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CurrencyValues $model */
/** @var array $currency_list */

$this->title = 'Create Currency Values';
$this->params['breadcrumbs'][] = ['label' => 'Currency Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currency-values-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'currency_list' => $currency_list,
    ]) ?>

</div>
