<?php

use common\assets\CurrencyConverterAsset;
use yii\helpers\Html;

/** @var array $currencies */
/** @var integer $ruNominalStart */

CurrencyConverterAsset::register($this);
?>

<div>
    <?= Html::beginTag('div', ['class' => 'list-group currency-convertor']); ?>


    <?= Html::beginTag('div', ['class' => 'list-group-item d-flex justify-content-between align-items-start']); ?>

    <?= Html::beginTag('div', ['class' => 'input-group mb-3']); ?>

    <?= Html::tag('span', 'RUB', ['class' => 'input-group-text']); ?>

    <?= Html::textInput('nominal', $ruNominalStart, ['class' => 'form-control main is-valid']);?>

    <?= Html::endTag('div'); ?>

    <?= Html::endTag('div'); ?>


    <?php foreach ($currencies as $currency): ?>
        <?= Html::beginTag('div', ['class' => 'list-group-item d-flex justify-content-between align-items-start']); ?>

        <?= Html::beginTag('div', ['class' => 'input-group mb-3']); ?>

        <?= Html::tag('span',  $currency['code'], ['class' => 'input-group-text']); ?>
    <?php //sprintf('%.4f', floor($number*10000*($number>0?1:-1))/10000*($number>0?1:-1)); ?>
        <?= Html::textInput('nominal', sprintf('%.4f',$ruNominalStart / $currency['unit_rate']), ['class' => 'form-control', 'v_unit_rate' => $currency['unit_rate']]);?>

        <?= Html::endTag('div'); ?>

        <?= Html::endTag('div'); ?>
    <?php endforeach;?>

    <?= Html::endTag('div'); ?>
</div>