<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "role".
 *
 * @property int $user_id
 * @property string $role_name
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'role_name'], 'required'],
            [['user_id'], 'integer'],
            [['role_name'], 'string', 'max' => 255],
            [['user_id', 'role_name'], 'unique', 'targetAttribute' => ['user_id', 'role_name']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'role_name' => 'Role Name',
        ];
    }


}
