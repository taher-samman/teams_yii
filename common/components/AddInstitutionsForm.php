<?php

namespace common\components;

use common\models\Institutions;
use common\models\InstitutionsTranslations;
use yii\base\Widget;
use yii\helpers\Html;
use common\models\Types;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

class AddInstitutionsForm extends Widget
{
    public $html;
    public function init()
    {
        parent::init();
        $this->html = $this->renderForm();
    }
    public function renderForm()
    {
        ob_start();
        $institutionsModel = new Institutions();
        $institutionsTransModel = new InstitutionsTranslations();
        $form = ActiveForm::begin([
            'id' => 'add-institution-form',
            'options' => ['class' => 'add-institution-form form-horizontal'],
            'action' => Url::toRoute(['institutions/add']),
        ]);
        echo '<h2 class="form-title">Add Institution</h2>';
        echo $form->field($institutionsTransModel, 'attribute_code[name]')->label(false)->textInput(['placeholder' => 'Name']);
        echo $form->field($institutionsModel, 'type')->dropDownList(Types::getTypes(), ['prompt' => 'Select Type', 'class' => 'form-control mt-2'])->label(false);
        echo Html::submitButton('Add', ['class' => 'btn btn-primary mt-2']);
        ActiveForm::end();
        $html = ob_get_clean();
        return $html;
    }
    public function run()
    {
        return Html::decode($this->html);
    }
}
