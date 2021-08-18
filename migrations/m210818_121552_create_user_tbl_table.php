<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_tbl}}`.
 */
class m210818_121552_create_user_tbl_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_tbl}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(),
            'email' => $this->string(),
            'password' => $this->string(),
            'authKey' => $this->string(),
            'accessToken' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_tbl}}');
    }
}
