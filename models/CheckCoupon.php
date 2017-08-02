<?php
/**
 * Created by PhpStorm.
 * User: Vitaut
 * Date: 07.06.2017
 * Time: 18:06
 */

namespace app\models;
use yii\base\Security;

class CheckCoupon extends Coupon
{
    public $code;
    public $sms_code;
    public $check_sms_code;
    const  SCENARIO_CHECK_COUPON_CODE = 'check_coupon_code';
    const  SCENARIO_CHECK_SMS_CODE = 'check_sms_code';
    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_CHECK_COUPON_CODE] = ['code'];
        $scenarios[self::SCENARIO_CHECK_SMS_CODE] = ['check_sms_code'];
        return $scenarios;
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'coupon' => 'Купон',
            'order_id' => 'Заказ №',
            'status'=> 'Статус купона',
            'code'=>'Проверочный код'
        ];
    }
    // validation rules
    public function rules()
    {
        return [
            ['code', 'required', 'on' => [self::SCENARIO_CHECK_COUPON_CODE,self::SCENARIO_CHECK_SMS_CODE]],
            ['code', 'search_coupon_code', 'on' => [self::SCENARIO_CHECK_COUPON_CODE,self::SCENARIO_CHECK_SMS_CODE]],
            ['check_sms_code', 'required', 'on' => self::SCENARIO_CHECK_SMS_CODE],
            ['check_sms_code', 'check_sms_code', 'on' => self::SCENARIO_CHECK_SMS_CODE],
        ];
    }


    public function search_coupon_code($attribute, $params, $validator)
    {
        $coupon = parent::find()->andWhere(['coupon'=>$this->code])->one();

        if (empty($coupon)) {
            $this->addError('code', 'Ошибка! Купон не найден');
            return false;

        } else {

            if ($coupon->status== Coupon::USED){
                $this->addError('code', 'Ошибка! Купон погашен');
                return false;
            }
            else {
                return true;
            }
        }


    }
    public function check_sms_code($attribute, $params, $validator)
    {
        $sms_code = parent::find()->andWhere(['sms_code'=>$this->check_sms_code])->one();

        if (empty($sms_code)) {
            $this->addError('check_sms_code', 'Ошибка! Проверочный код не действителен');
            return false;

        }
            else {
                return true;
            }



    }
public function cange_status_coupon(){

 $status_model=Coupon::find()->andWhere(['sms_code'=>$this->check_sms_code])->one();
    $status_model->status=1;
    //ToDo: Обработка ошибок
  $status_model->save();


}


}