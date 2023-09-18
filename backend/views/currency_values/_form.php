<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\CurrencyValues $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="currency-values-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'currency_id')->textInput() ?>

    <?= $form->field($model, 'nominal')->textInput() ?>

    <?= $form->field($model, 'rate')->textInput() ?>

    <?= $form->field($model, 'v_unit_rate')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
