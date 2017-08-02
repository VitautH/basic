<?php

namespace app\models;

use app;
use Yii;
use yii\base\Security;
use app\models\base\User as BaseUser;
use dektrium\user\models\Token;
use dektrium\user\Mailer;
use dektrium\user\Module;
use dektrium\user\traits\ModuleTrait;
use Swift_Message;
use dektrium\user\helpers\Password;
use dektrium\user\models\User as DectriumUser;
use linslin\yii2\curl;
class User extends BaseUser
{
    use ModuleTrait;
    const GUEST = null;
    const ADMIN = 1;
    const BUYER = 2;
    const MANAGER = 3;

    const BEFORE_CREATE = 'beforeCreate';
    const AFTER_CREATE = 'afterCreate';
    const BEFORE_REGISTER = 'beforeRegister';
    const AFTER_REGISTER = 'afterRegister';
    const BEFORE_CONFIRM = 'beforeConfirm';
    const AFTER_CONFIRM = 'afterConfirm';
    const SCENARIO_LOGIN = 'login';
    const SCENARIO_REGISTER = 'register';
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_CREATE = 'create';
    const  SCENARIO_UPDATE_ADMIN = 'update_admin';
    const SCENARIO_CHECK_REGISTER_CODE= 'SCENARIO_CHECK_REGISTER_CODE';
    public $password;
    public $login;
    public $old_password;
public $check_key;
// Может сделать событие?
private $action;
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        // LOGIN
        $scenarios[self::SCENARIO_LOGIN] = ['login',  'password'];

        $scenarios[self::SCENARIO_REGISTER] = ['username', 'email', 'password', 'phone'];
        $scenarios[self::SCENARIO_UPDATE] = ['firstname', 'name', 'email', 'phone', 'password', 'old_password'];
        $scenarios[self::SCENARIO_CREATE] = ['username', 'email', 'password', 'phone', 'role_id', 'firstname', 'name'];
        $scenarios[self::SCENARIO_UPDATE_ADMIN] = ['username', 'email', 'password', 'phone', 'role_id', 'firstname', 'name', 'flags', 'blocked_at','update_at',' confirmed_at','casino_id'];
        $scenarios[self::SCENARIO_CHECK_REGISTER_CODE] = ['check_key'];
        return $scenarios;
    }

    public function rules()
    {

        return [

            'usernameRequiredForLogin' => ['login', 'required', 'on' => [self::SCENARIO_LOGIN]],
            'loginTrim' => ['login', 'trim', 'on' => [self::SCENARIO_LOGIN]],
            'confirmationValidate' => [
                'login',
                function ($attribute) {

                    if ($this->login !== null) {
                        if ($this->findUser()['blocked_at'] !=null) {
                            $this->addError($attribute,'Ваш аккаунт заблокирован!');
                            return false;
                        }

                    }
                },
                'on' => [self::SCENARIO_LOGIN]
            ],
            'poasswordRequiredForLogin' => ['password', 'required', 'on' => [self::SCENARIO_LOGIN]],



            //Rules for Registration
// username rules
            'usernameLength' => ['username', 'string', 'min' => 3, 'max' => 255, 'on' => [self::SCENARIO_REGISTER, self::SCENARIO_CREATE, self::SCENARIO_UPDATE_ADMIN]],
            'usernameTrim' => ['username', 'filter', 'filter' => 'trim', 'on' => [self::SCENARIO_REGISTER, self::SCENARIO_CREATE, self::SCENARIO_UPDATE_ADMIN]],
            'usernameRequired' => ['username', 'required', 'on' => [self::SCENARIO_REGISTER, self::SCENARIO_CREATE, self::SCENARIO_UPDATE_ADMIN]],
            'usernameUnique' => [
                'username',
                'unique',

                'message' => Yii::t('user', 'Логин уже существует'), 'on' => [self::SCENARIO_REGISTER, self::SCENARIO_CREATE, self::SCENARIO_UPDATE_ADMIN]
            ],
            // email rules
            'emailTrim' => ['email', 'filter', 'filter' => 'trim', 'on' => [self::SCENARIO_REGISTER, self::SCENARIO_UPDATE, self::SCENARIO_CREATE, self::SCENARIO_UPDATE_ADMIN]],
            'emailRequired' => ['email', 'required', 'on' => [self::SCENARIO_REGISTER, self::SCENARIO_UPDATE, self::SCENARIO_CREATE, self::SCENARIO_UPDATE_ADMIN]],
            'emailPattern' => ['email', 'email', 'on' => [self::SCENARIO_REGISTER, self::SCENARIO_UPDATE, self::SCENARIO_CREATE, self::SCENARIO_UPDATE_ADMIN]],

            'emailUnique' => [
                'email',
                'unique',
                'message' => Yii::t('user', 'Такой e-mail уже существует')
            ],
            //, 'on' => self::SCENARIO_REGISTER
            // password rules
            'passwordRequired' => ['password', 'required', 'skipOnEmpty' => false, 'on' => [self::SCENARIO_REGISTER, self::SCENARIO_CREATE]],

            'passwordLength' => ['password', 'string', 'min' => 5, 'max' => 72, 'on' => [self::SCENARIO_REGISTER, self::SCENARIO_UPDATE, self::SCENARIO_CREATE]],
            // phone rules
            // ToDo: Отправка СМС при смене номера телефона
            'phoneRequired' => ['phone', 'required', 'on' => [self::SCENARIO_REGISTER, self::SCENARIO_UPDATE,self::SCENARIO_CREATE, self::SCENARIO_UPDATE_ADMIN]],
            'phoneUnique' => [
                'phone',
                'unique',
                'message' => 'Такой телефон уже существует', 'on' => [self::SCENARIO_REGISTER, self::SCENARIO_UPDATE,self::SCENARIO_CREATE, self::SCENARIO_UPDATE_ADMIN]
            ],
            'phoneType' => [['phone'], 'string', 'on' => [self::SCENARIO_REGISTER,self::SCENARIO_UPDATE, self::SCENARIO_CREATE, self::SCENARIO_UPDATE_ADMIN]],
            ['phone', 'match', 'pattern' => '#^\+?[0-9_-]+$#', 'message' => 'Неверный формат телефона'],

            //  Rules for Update
//            'ruleForUpdateForEmail' => [['email'], 'email', 'on' => self::SCENARIO_UPDATE],
//            'ruleForUpdateForFirstnameName' => [['firstname', 'name'], 'string', 'on' => self::SCENARIO_UPDATE],
//            'ruleForUpdateForPhone' => [['phone'], 'string', 'on' => self::SCENARIO_UPDATE],
//            'ruleForUpdateForPassword' => [['password'], 'string', 'on' => self::SCENARIO_UPDATE],
            'ruleForUpdateForOldPasswordRequired' => [['old_password'],'required', 'on'=> self::SCENARIO_UPDATE],
            'ruleForUpdateForOldPassword' => [['old_password'], 'safe', 'on' => self::SCENARIO_UPDATE],

            //  Rules for Create
            'ruleForCreateForEmail' => [['email'], 'email', 'on' => self::SCENARIO_CREATE],
            'ruleForCreateForFirstnameName' => [['firstname', 'name', 'username'], 'string', 'on' => self::SCENARIO_CREATE],
            'ruleForCreateForPhone' => [['phone'], 'string', 'on' => self::SCENARIO_CREATE],
            'ruleForCreateForPassword' => [['password'], 'string', 'on' => self::SCENARIO_CREATE],
            'ruleForCreateForRoleCasino' => [['role_id','casino_id'], 'integer', 'on' => self::SCENARIO_CREATE],

            //  Rules for Update Admin
            'ruleForUpdateAdminForEmail' => [['email'], 'email', 'on' => self::SCENARIO_UPDATE_ADMIN],
            'ruleForUpdateAdminForFirstnameName' => [['firstname', 'name', 'username'], 'string', 'on' => self::SCENARIO_UPDATE_ADMIN],
            'ruleForUpdateAdminForPhone' => [['phone'], 'string', 'on' => self::SCENARIO_UPDATE_ADMIN],
            'ruleForUpdateAdminForPassword' => [['password'], 'string', 'min' => 5, 'max' => 72, 'on' => self::SCENARIO_UPDATE_ADMIN],
            'ruleForUpdateForRoleCasino' => [['role_id','casino_id'], 'integer', 'on' => self::SCENARIO_UPDATE_ADMIN],
            'ruleForUpdateForBlocked' => [['blocked_at'], 'safe', 'on' => self::SCENARIO_UPDATE_ADMIN],
//  Rules for  SCENARIO_CHECK_REGISTER_CODE

            'check_keyRequired' => ['check_key', 'required', 'skipOnEmpty' => false, 'on' => [self::SCENARIO_CHECK_REGISTER_CODE]],
            'check_keyCheck' => ['check_key', 'CheckKey', 'on' => [self::SCENARIO_CHECK_REGISTER_CODE]],


        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'firstname' => 'Фамилия',
            'username' => 'Логин',
            'phone' => 'Телефон',
            'email' => 'E-mail',
            'password' => 'Пароль',
            'role_id' => 'Роль пользователя',
            'flags' => 'Статус'


        ];
    }
    public function CheckKey($attribute, $params, $validator)
    {
        $check_key = parent::find()->andWhere(['secret_key'=>$this->check_key])->one();

        if (empty($check_key)) {
            $this->addError('check_key', 'Ошибка! Проверочный код не действителен');
            return false;

        }
        else {
            return true;
        }



    }

    public function activationUser(){
        $activation=User::find()->andWhere(['secret_key'=>$this->check_key])->one();
        $activation->confirmed_at = date("Y-m-d H:i:s");
        $activation->flags = 1;
        $activation->save();
        $auto_login_object =  static::findIdentityByAccessToken($this->check_key, null);
if ($auto_login_object !== null){
    yii::$app->user->login($auto_login_object);
    return true;
}

    }

    // Проверка пароля при смене пароля в Профиле пользователя
    public function validate($attributeNames = null, $clearErrors = true)
    {

        if ($this->getScenario() == self::SCENARIO_UPDATE) {
            $this->updated_at = date("Y-m-d H:i:s");

            if (!password_verify($this->old_password, $this->password_hash)) {

                $this->addError('old_password', 'Проверьте текущий пароль');
                return false;
            }

        }
        if ($this->getScenario() == self::SCENARIO_LOGIN) {

            if (!password_verify($this->password, $this->findUser()['password_hash'])) {

                $this->addError('password', 'Пароль неверный');
                return false;
            }
        }
        return parent::validate($attributeNames, $clearErrors); // TODO: Change the autogenerated stub
    }
    public function load($data, $formName = null)
    {
        /*
         * Создание пользователя из админки. Активируем его
         */
        if ($this->getScenario() == self::SCENARIO_CREATE) {
            $this->flags = 1;
            $this->confirmed_at = date("Y-m-d H:i:s");
            $this->created_at = date("Y-m-d H:i:s");
            $this->updated_at = null;

        }

        /*
         * Регистрация. Необходимо смс подтвержление
         */
        if ($this->getScenario() == self::SCENARIO_REGISTER) {
            $this->secret_key = Yii::$app->getSecurity()->generateRandomString(4);

            $this->confirmed_at = null;
            $this->created_at = date("Y-m-d H:i:s");
            $this->flags = 0;
            $this->role_id = 2;
            $this->updated_at = null;
            $this->sendSMS();
        }




        return parent::load($data, $formName); // TODO: Change the autogenerated stub
    }


    public function beforeSave($insert)
    {
        /*
         *  Генерация пароля
         */
        if (!empty($this->password)){
            $this->password_hash = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        }

        /*
         *  Update Phone number
         */
        if ($this->getScenario() == self::SCENARIO_UPDATE){

           if($this->phone !== Yii::$app->getUser()->identity->phone) {
            $this->confirmed_at= null;
            $this->secret_key= Yii::$app->getSecurity()->generateRandomString(4);
            $this->action= 'change_phone';
               $this->sendSMS();
           }
        }
        /*
        * Обновление пользователя из Админки
        */
        if (($this->getScenario() == self::SCENARIO_UPDATE_ADMIN) or ($this->getScenario() == self::SCENARIO_CREATE)) {
            // Изменить статус пользователя
            if ($this->flags == 1) {
                $this->confirmed_at = date("Y-m-d H:i:s");

                $this->blocked_at = null;
            }
            if ($this->flags == 0) {
                $this->blocked_at = date("Y-m-d H:i:s");

            }


            $this->updated_at = date("Y-m-d H:i:s");

        }

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
public function afterSave($insert, $changedAttributes)
{
    if ($this->action=='change_phone'){
        $array= ['phone'=>Yii::$app->getUser()->identity->phone, 'username'=>Yii::$app->getUser()->identity->username, 'key'=>$this->secret_key];

       if(yii::$app->user->logout()){
           Yii::$app->session->setFlash(
               'check_sms_code',$array, false);
         return  yii::$app->getResponse()->redirect(Yii::$app->getHomeUrl());

       }
    }
    parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
}

    /*Login
    */
public function Login(){
    // Проверка на подтверждение
    if ($this->findUser()['confirmed_at'] ==null){
        Yii::$app->session->setFlash(
            'check_sms_code',['phone'=>$this->findUser()['phone'], 'username'=>$this->findUser()['username'], 'key'=>$this->findUser()['secret_key']]
    );
        return false;
    }
    $auto_login_object =  static::findIdentityByLogin($this->login, null);
    if ($auto_login_object !== null){
        yii::$app->user->login($auto_login_object);
        return true;
    }
}

    /*
     * Registration
     */
    public function Registration()
    {
        if ($this->getIsNewRecord() == false) {
            throw new \RuntimeException('Calling "' . __CLASS__ . '::' . __METHOD__ . '" on existing user');
        }

        $transaction = $this->getDb()->beginTransaction();

        try {


            $this->trigger(self::BEFORE_REGISTER);

            if (!$this->save()) {
                $transaction->rollBack();
                return false;
            }
            // ToDo: включить подтверждение на почту и смс
//    if ($this->module->enableConfirmation) {
//        /** @var Token $token */
//        $token = \Yii::createObject(['class' => Token::className(), 'type' => Token::TYPE_CONFIRMATION]);
//        $token->link('user', $this);
//    }

            else {
                $this->trigger(self::AFTER_REGISTER);

                $transaction->commit();

                return true;
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            \Yii::warning($e->getMessage());
            throw $e;
        }
    }



    /*
     * Вспомогательные методы
     */

    /** @inheritdoc */
    // Вход по смс коду. Привидение объекта к классу \dektrium\user\models\User
    public static function findIdentityByAccessToken($token, $type = null)
    {
        //secret_key
        return \dektrium\user\models\User::findOne(['secret_key' => $token]);


    }
    public static function findIdentityByLogin($login){
        return \dektrium\user\models\User::findOne(['username' => $login]);
    }

    private function senEmail()
    {
        $message = Swift_Message::newInstance()
            // Give the message a subject
            ->setSubject('Your subject')
            // Set the From address with an associative array
            ->setFrom(array($this->email => $this->username))
            // Set the To addresses with an associative array
            ->setTo(array('receiver@domain.org', 'other@domain.org' => 'A name'))
            // Give it a body
            ->setBody('Here is the message itself')
            // And optionally an alternative body
            ->addPart('<q>Here is the message itself</q>', 'text/html');
        return true;
    }

    private function sendSMS()
    {
        //Init curl
      //  $curl = new curl\Curl();

        //get http://example.com/
       // $response = $curl->get('http://bytehand.com:3800/send?id=30893&key=C0A581A64438DAF3&to='.$this->phone.'&from=CasinoIdiscount&text=Код:'.$this->secret_key.'');
        return true;
    }
private function findUser(){
    return User::find()->where(['username'=>$this->login])->asArray()->one();
}

}
