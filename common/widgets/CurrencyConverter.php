<?php

namespace common\widgets;

use yii\base\Widget;
use backend\models\Currency;
use \Datetime;

class CurrencyConverter extends Widget
{
    public $сurrencies;
    public $date;

    public function init()
    {
        parent::init();
        if ($this->сurrencies === null) {
            $this->сurrencies = [];
        }

        if ($this->date === null) {
            $current_date = new DateTime();
            $this->date = $current_date->format('Y-m-d');
        }
    }

    public function run()
    {
        $_currencies = [];

        $currency = new Currency();

        foreach ($currency->find()->where(['in', 'chart_code', $this->сurrencies])->all() as $currency) {
            $key = array_search($currency->chart_code, $this->сurrencies);

            $currency_val =  $currency->getCurrencyValues()->where(['date' => $this->date])->one();

            $_currencies[$key] = [
                'code' => $currency->chart_code,
                'nominal' => $currency_val->nominal,
                'unit_rate' => $currency_val->v_unit_rate,
            ];
        }

        ksort($_currencies);

        return $this->render('currencyConverter', [
            'ruNominalStart' => 100,
            'currencies' => $_currencies,
        ]);
    }
}