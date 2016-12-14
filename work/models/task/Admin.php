<?php

namespace app\models\task;

use Yii;

/**
 * This is the model class for table "{{%task_admin}}".
 *
 * @property string $id
 * @property string $username
 * @property string $password
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'string', 'max' => 16],
            [['username','password'],'required'],
            [['password'],'validatePassword'],
        ];
    }

    public function validatePassword($attribute,$params)
    {
        $user = self::findOne(['username'=>$this->username]);
        if($user['password'] == $this->password) {
            return true;
        }
        $this->addError($attribute,'Username or Password wrong！');
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
        ];
    }

    public function login()
    {
        if($this->validate()) {
            $session =  Yii::$app->session;
            $session->set('admin',$this->username);
            return true;
        }
        return false;
    }
}
