<?php

namespace app\models;
use app;
use Yii;
use app\models\base\User as BaseUser;

class User extends BaseUser
{
    const GUEST = null;
    const ADMIN = 1;
    const BUYER = 2;
    const MANAGER = 3;


}
