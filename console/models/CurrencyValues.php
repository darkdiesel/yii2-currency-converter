<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "currency_values".
 *
 * @property int $id
 * @property int $currency_id
 * @property int $nominal
 * @property float $rate
 * @property float $v_unit_rate
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
        return 'currency_values';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['currency_id', 'rate', 'v_unit_rate'], 'required'],
            [['currency_id', 'nominal'], 'integer'],
            [['rate', 'v_unit_rate'], 'number'],
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
        ];
    }

    /**
     * Gets query for [[Currency]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::class, ['id' => 'currency_id']);
    }
}
