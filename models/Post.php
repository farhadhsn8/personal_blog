<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property int $author_id
 * @property string|null $title
 * @property string|null $body
 * @property string|null $created_at
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['author_id'], 'required'],
//            [['author_id'], 'integer'],
            [['id'] , 'safe'],
            [['body'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['title'] , 'required'],
            [['body'] , 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Title',
            'body' => 'Body',
        ];
    }

    public function getComments()
    {
        return $this->hasMany(Comment::class, ['post_id' => 'id']);
    }

    public function getAuthor()
    {
        return $this->hasOne(UserTbl::class, ['id' => 'author_id']);
    }

    public function getTags()
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])
            ->viaTable('post_tag', ['post_id' => 'id']);
    }
}
