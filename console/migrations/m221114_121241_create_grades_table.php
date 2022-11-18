<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%grade}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%specialization}}`
 */
class m221114_121241_create_grades_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%grades}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'specialization_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);

        // creates index for column `specialization_id`
        $this->createIndex(
            '{{%idx-grade-specialization_id}}',
            '{{%grades}}',
            'specialization_id'
        );

        // add foreign key for table `{{%specialization}}`
        $this->addForeignKey(
            '{{%fk-grade-specialization_id}}',
            '{{%grades}}',
            'specialization_id',
            '{{%specializations}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%specialization}}`
        $this->dropForeignKey(
            '{{%fk-grade-specialization_id}}',
            '{{%grades}}'
        );

        // drops index for column `specialization_id`
        $this->dropIndex(
            '{{%idx-grade-specialization_id}}',
            '{{%grades}}'
        );

        $this->dropTable('{{%grades}}');
    }
}
