<?php

namespace common\components;

use common\extensions\components\LanguagesBootstrap;
use Yii;
use yii\base\Widget;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

class LanguageSwitcher extends Widget
{
    public $html;
    public function init()
    {
        parent::init();
        $this->html = $this->renderSwitcher();
    }
    public function renderSwitcher()
    {
        ob_start();
        echo '<div class="switcher-languages">';
        $langages = [];
        foreach (LanguagesBootstrap::$languages as $key => $language) {
            $langages[$language] = $language;
        }
        $form = ActiveForm::begin([
            'id' => 'switcher-languages-form',
            'options' => ['class' => 'switcher-languages-form'],
            'action' => Url::toRoute(['site/switch-language']),
        ]);
        echo $form->field(Yii::$app->user->identity, 'language')->dropDownList($langages, ['onchange' => 'this.form.submit()'])->label(false);
        ActiveForm::end();
        echo '</div>';
        return ob_get_clean();
    }
    public function run()
    {
        return Html::decode($this->html);
    }
}
