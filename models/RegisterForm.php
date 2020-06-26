<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
use yii\db\ActiveRecord;

/**
 * Signup form
 */
class RegisterForm extends ActiveRecord
{


    /**
     * {@inheritdoc}
     * 
     */
    public static function tableName(){
        return 'user';
    }
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['contact', 'required'],


            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }
    public function attributeLabels()
    {
        return [
            'username' => 'Your name',
            'email' => 'Your email address',
            'contact' => 'Phone Number',
            'password' => 'Password',
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
       
        $user = new User();
        $user->username = $this->username;
        $user->contact = $this->contact;
        $user->email = $this->email;
        $user->password = password_hash($this->password, PASSWORD_BCRYPT, ['cost' => 14]);
        $user->generateAuthKey();
        // $user->generateEmailVerificationToken();
        return $user->save();

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
    /**
 * Generates "remember me" authentication key
 */
public function generateAuthKey()
{
    $this->auth_key = Yii::$app->security->generateRandomString();
}

}
