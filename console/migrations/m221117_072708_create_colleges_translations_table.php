<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%institutions_translations}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%institutions}}`
 */
class m221117_072708_create_colleges_translations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%colleges_translations}}', [
            'id' => $this->primaryKey(),
            'attribute_code' => $this->string()->notNull(),
            'entity_id' => $this->integer()->notNull(),
            'language' => $this->string()->notNull(),
            'value' => $this->string()->notNull(),
        ]);

        // creates index for column `entity_id`
        $this->createIndex(
            '{{%idx-colleges_translations-entity_id}}',
            '{{%colleges_translations}}',
            'entity_id'
        );
        $this->createIndex(
            'unique-attribute_code-entity_id-language',
            '{{%colleges_translations}}',
            ['attribute_code', 'entity_id', 'language'],
            true
        );
        // add foreign key for table `{{%institutions}}`
        $this->addForeignKey(
            '{{%fk-colleges_translations-entity_id}}',
            '{{%colleges_translations}}',
            'entity_id',
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
        // drops foreign key for table `{{%institutions}}`
        $this->dropForeignKey(
            '{{%fk-colleges_translations-entity_id}}',
            '{{%colleges_translations}}'
        );

        // drops index for column `entity_id`
        $this->dropIndex(
            '{{%idx-colleges_translations-entity_id}}',
            '{{%colleges_translations}}'
        );
        $this->dropIndex(
            '{{%unique-attribute_code-entity_id-language}}',
            '{{%colleges_translations}}'
        );

        $this->dropTable('{{%colleges_translations}}');
    }
}
