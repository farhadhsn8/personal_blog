<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property int $id
 * @property string $title
 * @property string|null $created_at
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'safe'],
            [['title'], 'required'],
            [['created_at'], 'safe'],
            [['title'], 'string', 'max' => 12],
            [['title'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'created_at' => 'Created At',
        ];
    }


    public function getPosts()
    {
        return $this->hasMany(Post::class, ['id' => 'post_id'])
            ->viaTable('post_tag', ['tag_id' => 'id']);
    }
}
