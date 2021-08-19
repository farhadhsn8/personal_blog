<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment}}`.
 */
class m210819_122124_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'post_id' => $this->integer()->notNull(),
            'body' => $this->text()->notNull(),
            'verified' => $this->tinyInteger(),
            'created_at' => $this->dateTime()
        ]);

        $this->createIndex(
            'idx-comment-author_id',
            'comment',
            'author_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-comment-author_id',
            'comment',
            'author_id',
            'user_tbl',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-comment-post_id',
            'comment',
            'post_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-comment-post_id',
            'comment',
            'post_id',
            'post',
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
            'fk-comment-author_id',
            'comment'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-comment-author_id',
            'comment'
        );

        $this->dropForeignKey(
            'fk-comment-post_id',
            'comment'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-comment-post_id',
            'comment'
        );


        $this->dropTable('{{%comment}}');
    }
}
