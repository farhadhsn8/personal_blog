<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_tbl".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $email
 * @property string|null $password
 * @property string|null $authKey
 * @property string|null $accessToken
 */
class UserTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email'], 'string', 'max' => 80],
            [['password', 'authKey', 'accessToken'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',

        ];
    }
}
