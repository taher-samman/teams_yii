<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%institutions_translations}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%institutions}}`
 */
class m221117_072707_create_institutions_translations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%institutions_translations}}', [
            'id' => $this->primaryKey(),
            'attribute_code' => $this->string()->notNull(),
            'entity_id' => $this->integer()->notNull(),
            'language' => $this->string()->notNull(),
            'value' => $this->string()->notNull(),
        ]);

        // creates index for column `entity_id`
        $this->createIndex(
            '{{%idx-institutions_translations-entity_id}}',
            '{{%institutions_translations}}',
            'entity_id'
        );
        $this->createIndex(
            'unique-attribute_code-entity_id-language',
            '{{%institutions_translations}}',
            ['attribute_code', 'entity_id', 'language'],
            true
        );
        // add foreign key for table `{{%institutions}}`
        $this->addForeignKey(
            '{{%fk-institutions_translations-entity_id}}',
            '{{%institutions_translations}}',
            'entity_id',
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
        // drops foreign key for table `{{%institutions}}`
        $this->dropForeignKey(
            '{{%fk-institutions_translations-entity_id}}',
            '{{%institutions_translations}}'
        );

        // drops index for column `entity_id`
        $this->dropIndex(
            '{{%idx-institutions_translations-entity_id}}',
            '{{%institutions_translations}}'
        );
        $this->dropIndex(
            '{{%unique-attribute_code-entity_id-language}}',
            '{{%institutions_translations}}'
        );
        $this->dropTable('{{%institutions_translations}}');
    }
}
