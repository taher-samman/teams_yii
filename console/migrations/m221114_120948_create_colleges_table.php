<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%college}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%institution}}`
 */
class m221114_120948_create_colleges_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%colleges}}', [
            'id' => $this->primaryKey(),
            'institution_id' => $this->integer()->notNull(),
            'status' => $this->integer(1)->notNull()->defaultValue(1),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);

        // creates index for column `institution_id`
        $this->createIndex(
            '{{%idx-college-institution_id}}',
            '{{%colleges}}',
            'institution_id'
        );

        // add foreign key for table `{{%institution}}`
        $this->addForeignKey(
            '{{%fk-college-institution_id}}',
            '{{%colleges}}',
            'institution_id',
            '{{%institutions}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%institution}}`
        $this->dropForeignKey(
            '{{%fk-college-institution_id}}',
            '{{%colleges}}'
        );

        // drops index for column `institution_id`
        $this->dropIndex(
            '{{%idx-college-institution_id}}',
            '{{%colleges}}'
        );

        $this->dropTable('{{%colleges}}');
    }
}
