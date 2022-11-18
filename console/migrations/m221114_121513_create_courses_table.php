<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%course}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%semester}}`
 */
class m221114_121513_create_courses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%courses}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'semester_id' => $this->integer()->notNull(),
            'code' => $this->string(),
            'price' => $this->float()->notNull(),
            'description' => $this->string(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);

        // creates index for column `semester_id`
        $this->createIndex(
            '{{%idx-course-semester_id}}',
            '{{%courses}}',
            'semester_id'
        );

        // add foreign key for table `{{%semester}}`
        $this->addForeignKey(
            '{{%fk-course-semester_id}}',
            '{{%courses}}',
            'semester_id',
            '{{%semesters}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%semester}}`
        $this->dropForeignKey(
            '{{%fk-course-semester_id}}',
            '{{%courses}}'
        );

        // drops index for column `semester_id`
        $this->dropIndex(
            '{{%idx-course-semester_id}}',
            '{{%courses}}'
        );

        $this->dropTable('{{%courses}}');
    }
}
