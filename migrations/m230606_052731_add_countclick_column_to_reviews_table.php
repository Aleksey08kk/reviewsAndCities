<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%reviews}}`.
 */
class m230606_052731_add_countclick_column_to_reviews_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%reviews}}', 'countclick', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%reviews}}', 'countclick');
    }
}
