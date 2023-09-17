<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%currency}}`.
 */
class m231006_021504_create_currency_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%currency}}', [
            'id' => $this->primaryKey(),

            'currency_id' => $this->string()->notNull()->unique(),
            'num_code' => $this->char(3)->notNull()->unique(),
            'chart_code' => $this->char(3)->notNull()->unique(),
            'name' => $this->string()->notNull(),

            'status' => $this->boolean()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%currency}}');
    }
}
