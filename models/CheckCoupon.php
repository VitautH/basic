<?php
/**
 * Created by PhpStorm.
 * User: Vitaut
 * Date: 07.06.2017
 * Time: 18:06
 */

namespace app\models;


class CheckCoupon extends Coupon
{
    public $code;
    const  SCENARIO_CHECK_COUPON_CODE = 'check_coupon_code';

    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_CHECK_COUPON_CODE] = ['code'];

        return $scenarios;
    }

    // validation rules
    public function rules()
    {
        return [
            ['code', 'required', 'on' => self::SCENARIO_CHECK_COUPON_CODE],
            ['code', 'search_coupon_code', 'on' => self::SCENARIO_CHECK_COUPON_CODE],

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


//    // Проверка пароля при смене пароля в Профиле пользователя
//    public function validate($attributeNames = null, $clearErrors = true)
//    {
//        if ($this->getScenario()== self::SCENARIO_CHECK_COUPON_CODE) {
//
//
//            $this->addError('code', 'Ошибка! Купон не найден');
//            return false;
//
//        }


//        if ($this->getScenario()== self::SCENARIO_CHECK_COUPON_CODE) {
//
//$coupon = parent::find('==','coupon',$this->code)->one();
//            if( $coupon == null){
//                $this->addError('coupon', 'Ошибка! Купон не найден');
//                return false;
//
//            }
//            else {
//              return $coupon;
//            }
//        }
    // return parent::validate($attributeNames, $clearErrors); // TODO: Change the autogenerated stub
    //}


}