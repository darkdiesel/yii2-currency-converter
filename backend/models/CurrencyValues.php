<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "currency-values".
 *
 * @property int $id
 * @property int $currency_id
 * @property int $nominal
 * @property float $rate
 * @property float $v_unit_rate
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Currency $currency
 */
class CurrencyValues extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'currency-values';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['currency_id', 'rate', 'v_unit_rate', 'date'], 'required'],
            [['currency_id', 'nominal', 'created_at', 'updated_at'], 'integer'],
            [['rate', 'v_unit_rate'], 'number', 'numberPattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::class, 'targetAttribute' => ['currency_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'currency_id' => 'Currency ID',
            'nominal' => 'Nominal',
            'rate' => 'Rate',
            'v_unit_rate' => 'V Unit Rate',
            'date' => 'Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Currency]].
     *
     * @return \yii\db\ActiveQuery|CurrencyQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::class, ['id' => 'currency_id']);
    }

    /**
     * {@inheritdoc}
     * @return CurrencyValuesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CurrencyValuesQuery(get_called_class());
    }
}
