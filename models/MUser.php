<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class MUser extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return '{{%tb_user}}';
    }

    public static function findByAccount($account)
    {
//        $model = Yii::$app->db->createCommand('SELECT * FROM tb_user WHERE account=:account')->bindValue(':account', $account)->queryOne();
//        if ($model) {
//            $user = new MUser();
//            $user->load(['MUser'=>$model]);
//            return $user->name;
//        }

        $model = MUser::find()->where(['account' => $account])->one();
        if ($model !== null) {
            return $model;
        }
        return null;
    }

    public static function findByToken($token)
    {
        $model = MUser::find()->where(['accessToken' => $token])->one();
        if ($model !== null) {
            return $model;
        }
        return null;
    }

    public static function findByUserId($userId)
    {
        $model = MUser::find()->where(['userId' => $userId])->one();
        if ($model !== null) {
            return $model;
        }
        return null;
    }

    public function attributeLabels()
    {
        return [
            'account' => 'Account',
            'password' => 'Password',
            'name' => 'Name',
            'sex' => 'Sex',
            'userId' => 'UserId',
            'age'=> 'Age',
            'authKey' => 'AuthKey',
            'accessToken' => 'AccessToken',
        ];
    }

    public function rules()
    {
        return [
            [['userId', 'account', 'password'], 'required'],
            [['age'], 'integer'],
            [['account'], 'string', 'max'=>11],
            [['password'], 'string', 'min'=>6],
            [['userId'], 'string', 'max' => 32],
            [['name'], 'string', 'max' => 45],
            [['sex'], 'string'],
            [['authKey'], 'string', 'max'=>16],
            [['accessToken'], 'string', 'max'=>32],
        ];
    }

    public static function findIdentity($id)
    {
        return self::findByAccount($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findByToken($token);
    }

    public function getId()
    {
        return $this->account;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}