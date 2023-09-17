<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%currency_values}}`.
 */
class m230917_142527_create_currency_values_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%currency_values}}', [
            'id' => $this->primaryKey(),

            'currency_id' => $this->integer()->notNull(),
            'nominal' => $this->integer()->notNull()->defaultValue(1),
            'rate' => $this->float(7)->notNull(),
            'v_unit_rate' => $this->float(7)->notNull(),
        ]);

        // creates index for column `author_id`
        $this->createIndex(
            'idx-currency_values-currency_id',
            '{{%currency_values}}',
            'currency_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-currency_values-currency_id',
            '{{%currency_values}}',
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
            'fk-currency_values-currency_id',
            '{{%currency_values}}'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-currency_values-currency_id',
            '{{%currency_values}}'
        );

        $this->dropTable('{{%currency_values}}');
    }
}
