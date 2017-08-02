<?php

namespace app\components;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class Lang extends Component

{
//public static $basePath='app\common\messages\app.php';
    public static $sourceLang = 'ru';
 



    public $translations = [];



    private $_messageFormatter;



    public static $availableLangs = ['ru', 'en'];



    public static $translate = [

        'en'    => [],

        'ru'    => [],

    ];



    public function init()

    {

        if (!empty(Yii::$app->request->cookies)) {

            $session = Yii::$app->session;

            $cookies = Yii::$app->request->cookies;
            $language = $cookies->getValue('language', $session->get('language'));
            if (!empty($language) && in_array($language, Lang::$availableLangs)) {

                \Yii::$app->language = $language;

            }

        }

        parent::init();

    }



    public function translate($category, $message, $params, $language)

    {

        $message =  self::t($message, $params, $category, $language);

        return $this->format($message, $params, $language);

    }



    public static function t($message, $params = [], $category = 'app', $language = null)

    {

        if (empty($language) || !isset(self::$translate[$language])) {

            $language = \Yii::$app->language;

        }



        if ($language != self::$sourceLang) {

            self::loadTranslations($language, $category);

            if (!empty(self::$translate[$language][$category][$message])) {

                $message = self::$translate[$language][$category][$message];

            }

        }



        if (!empty($params)) {

//            $message = vsprintf($message, $params);

        }
//return var_dump(self::$translate['en']['app']['Войти']);
        return $message;

    }





    public static function plural($cnt, $message, $glueCnt = ' ')

    {

        if (empty($language) || !isset(self::$translate[$language])) {

            $language = \Yii::$app->language;

        }

        $category = 'app';



        self::loadTranslations($language, $category);

        if (!empty(self::$translate[$language][$category][$message])) {

            $message = self::$translate[$language][$category][$message];

        }



        if (is_array($message)) {

            $cases = [2, 0, 1, 1, 1, 2];

            $case = ($cnt % 100 > 4 && $cnt % 100 < 20)? 2: $cases[min($cnt % 10, 5)];

            if (isset($message[$case])) {

                $message = $message[$case];

            }

        }

        if (is_string($glueCnt)) {

            $message = $cnt.$glueCnt.$message;

        }

        return $message;

    }





    public static function loadTranslations($language, $category)

    {

        if (empty(self::$translate[$language][$category])) {

            $langFile = __DIR__."../messages/$language/$category.php";

            if (!is_file($langFile)) {

                $langFile = __DIR__."/../messages/$language/app.php";

            }

            if (is_file($langFile)) {

                self::$translate[$language][$category] = require($langFile);

            }

        }

    }



    public function format($message, $params, $language)

    {

        $params = (array) $params;

        if ($params === []) {

            return $message;

        }



        if (preg_match('~{\s*[\d\w]+\s*,~u', $message)) {

            $formatter = $this->getMessageFormatter();

            $result = $formatter->format($message, $params, $language);

            if ($result === false) {

                $errorMessage = $formatter->getErrorMessage();

                Yii::warning("Formatting message for language '$language' failed with error: $errorMessage. The message being formatted was: $message.", __METHOD__);



                return $message;

            } else {

                return $result;

            }

        }



        $p = [];

        foreach ($params as $name => $value) {

            $p['{' . $name . '}'] = $value;

        }



        return strtr($message, $p);

    }



    public function getMessageFormatter()

    {

        if ($this->_messageFormatter === null) {

            $this->_messageFormatter = new \yii\i18n\MessageFormatter();

        }

        return $this->_messageFormatter;


    }

}
