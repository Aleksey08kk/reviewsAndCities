<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%city}}`.
 */
class m230405_052050_create_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%city}}', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(),
            'date_create'=> $this->date(),
            //'viewed'=> $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%city}}');
    }
}
