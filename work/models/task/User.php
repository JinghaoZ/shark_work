<?php

namespace app\models\task;

use Yii;
use yii\web\UploadedFile;
/**
 * This is the model class for table "{{%task_user}}".
 *
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $nickname
 * @property string $logo
 * @property string $tel
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $repassword;
    public $verifyCode;

    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'nickname'], 'string', 'max' => 256],
            [['username'],'required','on'=>'login'],
            [['username'],'required','on'=>'register'],
            [['username',],'unique','on'=>'update'],
            [['username'],'validatePassword','on'=>'login'],
            [['password','tel','repassword'],'required','on'=>'register'],
            [['repassword'],'compare','compareAttribute'=>'password','on'=>'register'],
            /*[['logo'], 'string', 'max' => 128],*/
            [['tel'], 'string', 'max' => 13],

            ['verifyCode', 'required','on'=>'login'],
            ['verifyCode', 'captcha','on'=>'login','message'=>'Verify code error！','captchaAction'=>'user/captcha'],

            [['logo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
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
            'nickname' => 'Location',
            'logo' => 'Logo',
            'tel' => 'Phone    ',
            'repassword'=>'Password Confirm',
            'verifyCode'=>'Verify code',
        ];
    }

    public function validatePassword($attribute,$params)
    {
        $user = self::findOne(['username'=>$this->username]);
        if($user['password'] == $this->password) {
            return true;
        }
        $this->addError($attribute,'Username or Password error！');
    }

    public function scenarios()
    {
        $scenarios =  parent::scenarios();
        $scenarios['login'] = ['username','password','verifyCode'];
        $scenarios['update'] = ['password','tel','logo','nickname'];
        $scenarios['register'] = ['username','password','tel','nickname','repassword'];

        return $scenarios;
    }

    public function login()
    {
        if($this->validate())
        {
            $session =  Yii::$app->session;
            $session->set('username',$this->username);
            return true;
        }
        return false;
    }


    public function register()
    {
        
        if($this->validate())
        {
            if($this->save()){
                return true;
            }
        }
        return false;
    }

}
