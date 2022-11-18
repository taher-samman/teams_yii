<?php

namespace common\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class SidebarItems extends Widget
{
    public $html;
    public $nav;
    public function init()
    {
        parent::init();
        $this->html = $this->renderSidebar();
    }
    public function renderSidebar()
    {
        $html = '<nav>';
        $html .= '<a class="navbar-brand" href="' . Yii::$app->homeUrl . '">' . Yii::$app->name . '</a>';
        $html .= $this->nav;
        $html .= '</nav>';
        return $html;
    }
    public function run()
    {
        return Html::decode($this->html);
    }
}
