<?php

namespace app\models;

use Yii;
use app\models\base\Coupon as BaseCoupon;
/**
 * This is the model class for table "coupon".
 *
 * @property integer $id
 * @property integer $coupon
 * @property integer $product_id
 *
 * @property Products $product
 * @property Order[] $orders
 */
class Coupon extends BaseCoupon
{

}
