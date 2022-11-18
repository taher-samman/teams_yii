<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%semester}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%grace}}`
 */
class m221114_121332_create_semesters_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%semesters}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'grade_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);

        // creates index for column `grade_id`
        $this->createIndex(
            '{{%idx-semester-grade_id}}',
            '{{%semesters}}',
            'grade_id'
        );

        // add foreign key for table `{{%grades}}`
        $this->addForeignKey(
            '{{%fk-semester-grade_id}}',
            '{{%semesters}}',
            'grade_id',
            '{{%grades}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%grace}}`
        $this->dropForeignKey(
            '{{%fk-semester-grade_id}}',
            '{{%semesters}}'
        );

        // drops index for column `grade_id`
        $this->dropIndex(
            '{{%idx-semester-grade_id}}',
            '{{%semesters}}'
        );

        $this->dropTable('{{%semesters}}');
    }
}
