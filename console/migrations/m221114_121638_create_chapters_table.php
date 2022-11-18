<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chapter}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%course}}`
 */
class m221114_121638_create_chapters_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%chapters}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'course_id' => $this->integer()->notNull(),
            'price' => $this->float()->notNull(),
            'description' => $this->string(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);

        // creates index for column `course_id`
        $this->createIndex(
            '{{%idx-chapter-course_id}}',
            '{{%chapters}}',
            'course_id'
        );

        // add foreign key for table `{{%course}}`
        $this->addForeignKey(
            '{{%fk-chapter-course_id}}',
            '{{%chapters}}',
            'course_id',
            '{{%courses}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%course}}`
        $this->dropForeignKey(
            '{{%fk-chapter-course_id}}',
            '{{%chapters}}'
        );

        // drops index for column `course_id`
        $this->dropIndex(
            '{{%idx-chapter-course_id}}',
            '{{%chapters}}'
        );

        $this->dropTable('{{%chapters}}');
    }
}
