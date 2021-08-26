<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%role}}`.
 */
class m210826_120642_create_role_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%role}}', [
            'user_id' => $this->integer(),
            'role_name' =>$this->string(),
            'PRIMARY KEY(user_id, role_name)',
        ]);


        $this->createIndex(
            '{{%idx-role-user_id}}',
            '{{%role}}',
            'user_id'
        );

        // add foreign key for table `{{%post}}`
        $this->addForeignKey(
            '{{%fk-role-user_id}}',
            '{{%role}}',
            'user_id',
            '{{%user_tbl}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            '{{%fk-role-user_id}}',
            '{{%role}}'
        );

        // drops index for column `post_id`
        $this->dropIndex(
            '{{%idx-role-user_id}}',
            '{{%role}}'
        );

        $this->dropTable('{{%role}}');
    }
}
