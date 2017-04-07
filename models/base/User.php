<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $user_id
 * @property string $login
 * @property string $pass
 * @property string $mail
 * @property string $phone
 * @property integer $role_id
 *
 * @property Role $role
 * @property UserPayment[] $userPayments
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'pass', 'mail', 'phone'], 'string'],
            [['role_id'], 'integer'],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'id_role']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'login' => 'Login',
            'pass' => 'Pass',
            'mail' => 'Mail',
            'phone' => 'Phone',
            'role_id' => 'Role ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id_role' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPayments()
    {
        return $this->hasMany(UserPayment::className(), ['user_id' => 'user_id']);
    }
}
