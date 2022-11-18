<?php

namespace common\extensions\components;

use Yii;
use yii\base\BootstrapInterface;

class LanguagesBootstrap implements BootstrapInterface
{
    static $languages = ['en-US', 'ar-AR'];
    public function bootstrap($app)
    {
        if (!Yii::$app->request->isConsoleRequest) {
            Yii::$app->language = userLang();
        }
    }
}
