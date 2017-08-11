<?php

namespace app\components;

use app\models\Order;
use app\models\Coupon;
use Yii;
use app\models\User;
use yii\base\Component;
use yii\base\InvalidConfigException;

require_once __DIR__ . '/bepaid/lib/beGateway.php';

class Bepaid extends Component
{
    const STATUS_SUCCESS = 'successful';
    const STATUS_FAILED = 'failed';

    const BASE_URL_LIVE = 'https://timegame.by/bepaid/';
    const BASE_URL_TEST = 'https://timegame.by/bepaid/';
    const BASE_URL_LOCAL = 'http://www-new.local/bepaid/';

    public static $baseUrl;

    public $shopId = 363;
    public $shopKey = '4f585d2709776e53d080f36872fd1b63b700733e7624dfcadd057296daa37df6';
    public $shopPubKey = '2346f6d1-db18-4e53-b17b-ded58912f9a2';
    public $gatewayBase = 'https://gateway.bepaid.by';
    public $checkoutBase = 'https://checkout.bepaid.by';

    /*

     Id магазина 363
    Ключ 4f585d2709776e53d080f36872fd1b63b700733e7624dfcadd057296daa37df6
    pub key: 2346f6d1-db18-4e53-b17b-ded58912f9a2

    c 3-D Secure
    Id магазина  336
    Ключ 28421dbd7ec390c927b909d3deecffde90b848c1f95693922e2b73862ececc0e
    pub key: 7d5d16ac-2f30-45e7-a54d-85fef4181f36

    Тестовая карта
    Карта 4200 0000 0000 0000
    3-D карта 4012 0010 3714 1112
    Ivan Ivanov
    CVC 123
    Срок действия для успешной оплаты 01/20
    Для отказа 10/20


    4a30fb9224be73cb899253c08736c0cb3de6dcfd791498eb26e4f32dbdc7c9d7
    https://api-test.idiscount.by/bepaid/success?status=successful&uid=1507051-2cba3c4f80&token=4a30fb9224be73cb899253c08736c0cb3de6dcfd791498eb26e4f32dbdc7c9d7

    */
    public function init()
    {
        self::$baseUrl = self::BASE_URL_LIVE;

        if (!empty($_SERVER['HTTP_HOST'])) {
            $host = $_SERVER['HTTP_HOST'];
            if (stripos($host, 'local')) {
                self::$baseUrl = self::BASE_URL_LOCAL;
            } elseif (stripos($host, 'test')) {
                self::$baseUrl = self::BASE_URL_TEST;
            }
        }

        \beGateway\Settings::$shopId = $this->shopId;
        \beGateway\Settings::$shopKey = $this->shopKey;
        \beGateway\Settings::$shopPubKey = $this->shopPubKey;
        \beGateway\Settings::$gatewayBase = $this->gatewayBase;
        \beGateway\Settings::$checkoutBase = $this->checkoutBase;

        parent::init();
    }

    public function getToken(Order $order, $data = [])
    {
        $transaction = new \beGateway\GetPaymentToken;

        $transaction->money->setAmount($order->amount);
        $transaction->money->setCurrency($order->currency);
        $transaction->setDescription($order->title);
        $transaction->setTrackingId($order->id);
        $transaction->setLanguage(Yii::$app->language);
        $transaction->setNotificationUrl(self::$baseUrl . 'notify');
        $transaction->setSuccessUrl(self::$baseUrl . 'success');
        $transaction->setDeclineUrl(self::$baseUrl . 'decline');
        $transaction->setFailUrl(self::$baseUrl . 'fail');
        $transaction->setCancelUrl(self::$baseUrl . 'cancel');
        $transaction->customer->setEmail($order->customersEmail);
        $transaction->setAddressHidden();
        $response = $transaction->submit();
        if ($response->isSuccess()) {
            return $response;
        }
    }

    /**
     * @param $uid
     * @return bool
     */
    public function getTransaction($uid)
    {
        $result = false;
        $query = new \beGateway\QueryByUid();
        $query->setUid($uid);
        $query->setLanguage('en');

        $response = $query->submit();

        $respArray = $response->getResponseArray();
        if (!empty($respArray['transaction'])) {
            $result = $respArray['transaction'];
        }
        return $result;
    }

    public function QueryByToken($token)
    {
        $query = new \beGateway\QueryByToken();
        $query->setToken($token);
        return $query->submit();
    }

    public function notification()
    {
        $webhook = new \beGateway\Webhook;
        return $this->_checkPayment($webhook);

    }

    private function _checkPayment($webhook)
    {
        $order_id = $webhook->getTrackingId();
        $type = $webhook->getResponse()->transaction->type;
        $uid = $webhook->getResponse()->transaction->uid;
        if (in_array($type, array('payment', 'authorization'))) {
            $status = $webhook->getStatus();
            if ($webhook->isSuccess()) {
                if ($type == 'payment') {
                    $data = ['order_id' => $order_id, 'uid' => $uid];

                    return Order::payment($data);
                } elseif ($webhook->isFailed()) {
                    $order_id = $webhook->getTrackingId();
                    if (Order::deleteAll(['id' => $order_id])) {
                        return true;
                    }

                } elseif ($webhook->isIncomplete()) {
                    if (Order::deleteAll(['id' => $order_id])) {
                        return true;
                    }

                } elseif ($webhook->isError()) {
                    if (Order::deleteAll(['id' => $order_id])) {
                        return true;
                    }

                } else {

                }
            }
        }
    }
}