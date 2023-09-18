<?php

namespace app\models;

use models\CurrencyValues;

/**
 * This is the ActiveQuery class for [[CurrencyValues]].
 *
 * @see CurrencyValues
 */
class CurrencyValuesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CurrencyValues[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CurrencyValues|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
