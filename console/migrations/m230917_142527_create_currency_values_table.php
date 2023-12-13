<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%currency-values}}`.
 */
class m230917_142527_create_currency_values_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%currency-values}}', [
            'id' => $this->primaryKey(),

            'currency_id' => $this->integer()->notNull(),
            'nominal' => $this->integer()->notNull()->defaultValue(1),
            'rate' => $this->float(7)->notNull(),
            'v_unit_rate' => $this->float(7)->notNull(),

            'date' => $this->date()->notNull(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // creates index for column `author_id`
        $this->createIndex(
            'idx-currency-values-currency_id',
            '{{%currency-values}}',
            'currency_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-currency-values-currency_id',
            '{{%currency-values}}',
            'currency_id',
            '{{%currency}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-currency-values-currency_id',
            '{{%currency-values}}'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-currency-values-currency_id',
            '{{%currency-values}}'
        );

        $this->dropTable('{{%currency-values}}');
    }
}
