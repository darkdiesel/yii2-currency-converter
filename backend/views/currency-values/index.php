<?php

use backend\models\Currency;
use backend\models\CurrencyValues;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\CurrencyValuesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Currency Values';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currency-values-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Currency Values', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'currency_id',
                'label' => 'Currency [ID]',
                'value' => function ($model, $key, $index, $column) {
                    if ($model->currency_id){
                        //@TODO: get with relations
                        $currency = Currency::findOne($model->currency_id);

                        return sprintf('%s [id:%s]', $currency->name, $model->currency_id);
                    } else {
                        return "null";
                    }
                }
            ],
            'nominal',
            'rate',
            'v_unit_rate',
            'date',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CurrencyValues $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
