<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reviews}}`.
 */
class m230405_052133_create_reviews_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%reviews}}', [
            'id' => $this->primaryKey(),
            'id_city'=> $this->integer(),
            'title'=> $this->string(),
            'text'=> $this->string(),
            'rating'=> $this->integer(),
            'img'=> $this->string(),
            'id_author'=> $this->integer(),
            'date_create'=> $this->date(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%reviews}}');
    }
}
