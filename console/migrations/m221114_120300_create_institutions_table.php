<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%institutions}}`.
 */
class m221114_120300_create_institutions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%institutions}}', [
            'id' => $this->primaryKey(),
            'type' => $this->integer()->notNull(),
            'status' => $this->integer(1)->notNull()->defaultValue(1),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%institutions}}');
    }
}
