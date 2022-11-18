<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%specialization}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%college}}`
 */
class m221114_121119_create_specializations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%specializations}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'college_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);

        // creates index for column `college_id`
        $this->createIndex(
            '{{%idx-specialization-college_id}}',
            '{{%specializations}}',
            'college_id'
        );

        // add foreign key for table `{{%college}}`
        $this->addForeignKey(
            '{{%fk-specialization-college_id}}',
            '{{%specializations}}',
            'college_id',
            '{{%colleges}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%college}}`
        $this->dropForeignKey(
            '{{%fk-specialization-college_id}}',
            '{{%specializations}}'
        );

        // drops index for column `college_id`
        $this->dropIndex(
            '{{%idx-specialization-college_id}}',
            '{{%specializations}}'
        );

        $this->dropTable('{{%specializations}}');
    }
}
