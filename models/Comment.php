<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property int $author_id
 * @property int $post_id
 * @property string $body
 * @property int|null $verified
 * @property string|null $created_at
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id', 'post_id', 'body'], 'required'],
            [['author_id', 'post_id', 'verified'], 'integer'],
            [['body'], 'string'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author ID',
            'post_id' => 'Post ID',
            'body' => 'Body',
            'verified' => 'Verified',
            'created_at' => 'Created At',
        ];
    }

    public function getAuthor()
    {
        return $this->hasOne(UserTbl::class, ['id' => 'author_id']);
    }

    public function getPost()
    {
        return $this->hasOne(Post::class, ['id' => 'post_id']);
    }
}
