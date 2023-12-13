<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use common\widgets\CurrencyConverter;

$this->title = 'Currency Converter';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= CurrencyConverter::widget(['сurrencies' => ['USD', 'EUR', 'CNY']]) ?>
</div>
