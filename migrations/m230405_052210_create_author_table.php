<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%author}}`.
 */
class m230405_052210_create_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%author}}', [
            'id' => $this->primaryKey(),
            'fio'=> $this->string(),
            'email'=> $this->string(),
            'phone'=> $this->integer(),
            'date_create'=> $this->date(),
            'password'=> $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%author}}');
    }
}
