<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%institutions}}`.
 */
class m221114_143125_add_status_column_to_institutions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%specializations}}', 'status', $this->integer(1));
        $this->addColumn('{{%grades}}', 'status', $this->integer(1));
        $this->addColumn('{{%semesters}}', 'status', $this->integer(1));
        $this->addColumn('{{%courses}}', 'status', $this->integer(1));
        $this->addColumn('{{%chapters}}', 'status', $this->integer(1));
        $this->addColumn('{{%videos}}', 'status', $this->integer(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%specializations}}', 'status');
        $this->dropColumn('{{%grades}}', 'status');
        $this->dropColumn('{{%semesters}}', 'status');
        $this->dropColumn('{{%courses}}', 'status');
        $this->dropColumn('{{%chapters}}', 'status');
        $this->dropColumn('{{%videos}}', 'status');
    }
}
