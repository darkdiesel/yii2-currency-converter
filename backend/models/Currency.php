<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property int $id
 * @property string $currency_id
 * @property string $num_code
 * @property string $chart_code
 * @property string $name
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property CurrencyValues[] $currencyValues
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['currency_id', 'num_code', 'chart_code', 'name', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['currency_id', 'name'], 'string', 'max' => 255],
            [['num_code', 'chart_code'], 'string', 'max' => 3],
            [['currency_id'], 'unique'],
            [['num_code'], 'unique'],
            [['chart_code'], 'unique'],
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
            'num_code' => 'Num Code',
            'chart_code' => 'Chart Code',
            'name' => 'Name',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[CurrencyValues]].
     *
     * @return \yii\db\ActiveQuery|CurrencyValuesQuery
     */
    public function getCurrencyValues()
    {
        return $this->hasMany(CurrencyValues::class, ['currency_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return CurrencyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CurrencyQuery(get_called_class());
    }
}
