<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use kartik\form\ActiveForm;
use kartik\date\DatePicker;

/** @var yii\web\View $this */
/** @var backend\models\CurrencyValues $model */
/** @var array $currency_list */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="currency-values-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'currency_id')->dropDownList($currency_list) ?>

    <?= $form->field($model, 'nominal')->textInput() ?>

    <?= $form->field($model, 'rate')->textInput() ?>

    <?= $form->field($model, 'v_unit_rate')->textInput() ?>

    <?php
        $current_date = new DateTime();
    ?>

    <?= $form->field($model, 'date')->widget(DatePicker::class, [
        'options' => ['placeholder' => 'Enter date ...', ],
        'name' => 'date',
        'value' => $current_date->format('d/m/Y'),
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd/mm/yyyy'
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
