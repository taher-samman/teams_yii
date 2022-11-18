<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%videos}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%chapter}}`
 */
class m221114_121734_create_videos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%videos}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->string(),
            'url' => $this->string()->notNull(),
            'chapter_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);

        // creates index for column `chapter_id`
        $this->createIndex(
            '{{%idx-videos-chapter_id}}',
            '{{%videos}}',
            'chapter_id'
        );

        // add foreign key for table `{{%chapter}}`
        $this->addForeignKey(
            '{{%fk-videos-chapter_id}}',
            '{{%videos}}',
            'chapter_id',
            '{{%chapters}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%chapter}}`
        $this->dropForeignKey(
            '{{%fk-videos-chapter_id}}',
            '{{%videos}}'
        );

        // drops index for column `chapter_id`
        $this->dropIndex(
            '{{%idx-videos-chapter_id}}',
            '{{%videos}}'
        );

        $this->dropTable('{{%videos}}');
    }
}
