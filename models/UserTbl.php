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
class UserTbl extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
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
            [['username' ,'email'] , 'string', 'max' => 80],
            [['username' ,'email'] , 'required'],
            [['username' ,'email'] , 'unique'],
            [['email'] , 'email'],
            [[ 'authKey', 'accessToken'], 'string', 'max' => 255],
            [['password'] , 'string', 'max' => 255  ]
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

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token , $type=null)
    {
        return self::findOne(['accessToken' => $token]);
    }

    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

    public  function getId()
    {
        return $this->id;
    }

    public  function getAuthKey()
    {
        return $this->authKey;
    }

    public  function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public  function validatePassword($password)
    {
        return password_verify($password , $this->password);
    }

    public function getComments()
    {
        return $this->hasMany(Comment::class, ['author_id' => 'id']);
    }

    public function getPosts()
    {
        return $this->hasMany(Post::class, ['author_id' => 'id']);
    }

}
