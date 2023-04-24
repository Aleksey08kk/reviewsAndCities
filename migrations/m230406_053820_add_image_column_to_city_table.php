<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%city}}`.
 */
class m230406_053820_add_image_column_to_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('city', 'image', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('city', 'image');
    }
}
