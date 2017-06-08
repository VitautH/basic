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

class User extends BaseUser
{
use ModuleTrait;
    const GUEST = null;
    const ADMIN = 1;
    const BUYER = 2;
    const MANAGER = 3;

    const BEFORE_CREATE   = 'beforeCreate';
    const AFTER_CREATE    = 'afterCreate';
    const BEFORE_REGISTER = 'beforeRegister';
    const AFTER_REGISTER  = 'afterRegister';
    const BEFORE_CONFIRM  = 'beforeConfirm';
    const AFTER_CONFIRM   = 'afterConfirm';

    const SCENARIO_REGISTER = 'register';
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_CREATE = 'create';
    const  SCENARIO_UPDATE_ADMIN= 'update_admin';
    public $password;
    public $login;
    public $old_password;


    public function scenarios()
    {
        $scenarios = parent::scenarios();
// ToDo: Проверка полей регистрации пользователя
        $scenarios[self::SCENARIO_REGISTER] = ['username', 'email', 'password', 'phone'];
        $scenarios[self::SCENARIO_UPDATE] = ['firstname', 'name', 'email', 'phone', 'password', 'old_password'];
        $scenarios[self::SCENARIO_CREATE] = ['username', 'email', 'password', 'phone', 'role_id','firstname', 'name'];
        $scenarios[self::SCENARIO_UPDATE_ADMIN] = ['username', 'email', 'password', 'phone', 'role_id','firstname', 'name'];
        return $scenarios;
    }

    public function rules()
    {
        //ToDo: Правила валидации/ безопастности
        return [
            //Rules for Registration
// username rules
            'usernameLength' => ['username', 'string', 'min' => 3, 'max' => 255, 'on' => [self::SCENARIO_REGISTER, self::SCENARIO_CREATE, self::SCENARIO_UPDATE_ADMIN]],
            'usernameTrim' => ['username', 'filter', 'filter' => 'trim', 'on' => [self::SCENARIO_REGISTER, self::SCENARIO_CREATE, self::SCENARIO_UPDATE_ADMIN]],
            'usernameRequired' => ['username', 'required', 'on' =>[self::SCENARIO_REGISTER, self::SCENARIO_CREATE, self::SCENARIO_UPDATE_ADMIN]],
            'usernameUnique' => [
                'username',
                'unique',

                'message' => Yii::t('user', 'Логин уже существует'), 'on' => [self::SCENARIO_REGISTER, self::SCENARIO_CREATE, self::SCENARIO_UPDATE_ADMIN]
            ],
            // email rules
            'emailTrim' => ['email', 'filter', 'filter' => 'trim', 'on' => [self::SCENARIO_REGISTER, self::SCENARIO_CREATE, self::SCENARIO_UPDATE_ADMIN]],
            'emailRequired' => ['email', 'required', 'on' => [self::SCENARIO_REGISTER, self::SCENARIO_CREATE, self::SCENARIO_UPDATE_ADMIN]],
            'emailPattern' => ['email', 'email', 'on' => [self::SCENARIO_REGISTER, self::SCENARIO_CREATE, self::SCENARIO_UPDATE_ADMIN]],

            'emailUnique' => [
                'email',
                'unique',
                'message' => Yii::t('user', 'Такой e-mail уже существует')
            ],
            //, 'on' => self::SCENARIO_REGISTER
            // password rules
            'passwordRequired' => ['password', 'required', 'skipOnEmpty' => false, 'on' => [self::SCENARIO_REGISTER, self::SCENARIO_CREATE]],
            'passwordLength' => ['password', 'string', 'min' => 5, 'max' => 72, 'on' =>[self::SCENARIO_REGISTER, self::SCENARIO_CREATE]],
            // phone rules
            'phoneRequired' => ['phone', 'required', 'on' => [self::SCENARIO_REGISTER, self::SCENARIO_CREATE, self::SCENARIO_UPDATE_ADMIN]],
            'phoneUnique' => [
                'phone',
                'unique',
                'message' => 'Такой телефон уже существует', 'on' => [self::SCENARIO_REGISTER, self::SCENARIO_CREATE, self::SCENARIO_UPDATE_ADMIN]
            ],
            'phoneType' => [['phone'], 'string', 'on' => [self::SCENARIO_REGISTER, self::SCENARIO_CREATE, self::SCENARIO_UPDATE_ADMIN]],
            ['phone', 'match', 'pattern' => '#^\+?[0-9_-]+$#', 'message' => 'Неверный формат телефона'],

            //  Rules for Update
            'ruleForUpdateForEmail' => [['email'], 'email', 'on' => self::SCENARIO_UPDATE],
            'ruleForUpdateForFirstnameName' => [['firstname', 'name'], 'string', 'on' => self::SCENARIO_UPDATE],
            'ruleForUpdateForPhone' => [['phone'], 'string', 'on' => self::SCENARIO_UPDATE],
            'ruleForUpdateForPassword' => [['password'], 'string', 'on' => self::SCENARIO_UPDATE],
            'ruleForUpdateForOldPassword' => [['old_password'], 'safe', 'on' => self::SCENARIO_UPDATE],

            //  Rules for Create
            'ruleForCreateForEmail' => [['email'], 'email', 'on' => self::SCENARIO_CREATE],
            'ruleForCreateForFirstnameName' => [['firstname', 'name', 'username'], 'string', 'on' => self::SCENARIO_CREATE],
            'ruleForCreateForPhone' => [['phone'], 'string', 'on' => self::SCENARIO_CREATE],
            'ruleForCreateForPassword' => [['password'], 'string', 'on' => self::SCENARIO_CREATE],
            'ruleForCreateForRole' => [['role_id'], 'integer', 'on' => self::SCENARIO_CREATE],

            //  Rules for Update Admin
            'ruleForUpdateAdminForEmail' => [['email'], 'email', 'on' => self::SCENARIO_UPDATE_ADMIN],
            'ruleForUpdateAdminForFirstnameName' => [['firstname', 'name', 'username'], 'string', 'on' => self::SCENARIO_UPDATE_ADMIN],
            'ruleForUpdateAdminForPhone' => [['phone'], 'string', 'on' => self::SCENARIO_UPDATE_ADMIN],
            'ruleForUpdateAdminForPassword' => [['password'], 'string', 'min' => 5, 'max' => 72, 'on' => self::SCENARIO_UPDATE_ADMIN],

            'ruleForUpdateAdminForRole' => [['role_id'], 'integer', 'on' => self::SCENARIO_UPDATE_ADMIN],
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
            'role_id'=> 'Роль пользователя',



        ];
    }
    // Проверка пароля при смене пароля в Профиле пользователя
public function validate($attributeNames = null, $clearErrors = true)
{

    if ($this->getScenario()== self::SCENARIO_UPDATE) {


        if (!password_verify($this->old_password, $this->password_hash)) {

            $this->addError('old_password', 'Проверьте текущий пароль');
            return false;
        }
    }
    return parent::validate($attributeNames, $clearErrors); // TODO: Change the autogenerated stub
}

    public function load($data, $formName = null)
    {
        if ($this->getScenario()== self::SCENARIO_CREATE) {
$this->flags= 1;
$this->confirmed_at= time();
$this->created_at= time();

        }
           $this->updated_at = time();
           $this->generatePasswordHash($data);

        return parent::load($data, $formName); // TODO: Change the autogenerated stub
    }
// Генерация пароля
    private function generatePasswordHash($data)
    {

        if (!empty($data['User']['password'])) {
            $this->password_hash = Yii::$app->getSecurity()->generatePasswordHash($data['User']['password']);
        }


    }

    // Load Attributes for Registration
    public function registration ($data) {
   $this->password= $data['User']['password'];
        $this->email= $data['User']['email'];
        $this->phone= $data['User']['phone'];
        $this->username= $data['User']['username'];

      if ($this->validate($this)){
          if($this->register()){
              return true;
          }
      }
      else {
          return false;
      }
    }
    // Registration - ToDo: вынести в отдельный класса
    private function register (){
if ($this->getIsNewRecord() == false)
{
throw new \RuntimeException('Calling "' . __CLASS__ . '::' . __METHOD__ . '" on existing user');
}

$transaction = $this->getDb()->beginTransaction();

try {

     $this->secret_key= Yii::$app->getSecurity()->generateRandomString(4);
    $message = Swift_Message::newInstance()
        // Give the message a subject
        ->setSubject('Your subject')

        // Set the From address with an associative array
        ->setFrom(array('john@doe.com' => 'John Doe'))

        // Set the To addresses with an associative array
        ->setTo(array('receiver@domain.org', 'other@domain.org' => 'A name'))

        // Give it a body
        ->setBody('Here is the message itself')

        // And optionally an alternative body
        ->addPart('<q>Here is the message itself</q>', 'text/html');
    $this->confirmed_at= time();
    $this->created_at = time();
    $this->flags=1;
$this->password_hash=   $this->password_hash = Yii::$app->getSecurity()->generatePasswordHash($this->password);
$this->role_id= 2;


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


    $this->trigger(self::AFTER_REGISTER);

    $transaction->commit();
    Yii::$app->session->setFlash(
        'success_registration', 'Уважаемый '.$this->username.'!<br> Поздравляем Вас с успешной регистрацией!'

    );
    return true;
} catch (\Exception $e) {
    $transaction->rollBack();
    \Yii::warning($e->getMessage());
    throw $e;
}
}

    /** @inheritdoc */
    // Вход по смс коду. Привидение объекта к классу \dektrium\user\models\User
    public static function findIdentityByAccessToken($token, $type = null)
    {
        //secret_key
        return  \dektrium\user\models\User::findOne(['auth_key' => $token]);


    }



}
