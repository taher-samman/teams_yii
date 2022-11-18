<?php

namespace common\components;

use common\models\Institutions;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use common\models\Types;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Url;

class SpecializationsGrid extends Widget
{
    public $html;
    public $college;
    public function init()
    {
        parent::init();
        $this->html = $this->renderGrid();
    }
    public function renderGrid()
    {
        ob_start();
        echo '
        <div class="d-flex">
            <h5 class="mb-0 align-self-center">Specializations Grid</h5>
            <button type="button" class="btn shadow-none border-0 ms-auto" data-bs-toggle="modal" data-bs-target="#helper-modal" data-college="' . $this->college . '" onclick="addSpecializationForm(this)">' . FA::icon('plus') . '</button>
        </div>
        ';
        // $institutions = Institutions::find()->all();
        // if (count($institutions) > 0) {
        //     echo '
        //     <table class="table-institutions w-100">
        //         <thead>
        //             <tr>
        //                 <th scope="col"></th>
        //                 <th scope="col">#</th>
        //                 <th scope="col">Name</th>
        //                 <th scope="col">Type</th>
        //                 <th scope="col">Status</th>
        //                 <th scope="col"></th>
        //             </tr>
        //         </thead>
        //     ';
        //     foreach ($institutions as $institution) {
        //         echo '
        //         <tbody data-institution="' . $institution->id . '">
        //             <tr>
        //                 <th scope="row">' . Html::a(FA::icon('trash'), Url::to(['institutions/delete', 'id' => $institution->id]), ['data-confirm' => 'are you sure!']) . '
        //                 <button type="button" class="btn shadow-none border-0 ms-auto" data-bs-toggle="modal" data-bs-target="#helper-modal" data-institution="' . $institution->id . '" onclick="editInstitutionForm(this)">' . FA::icon('pencil-square-o') . '</button>
        //                 </th>
        //                 <th scope="row">' . $institution->id . '</th>
        //                 <td>' . $institution->name . '</td>
        //                 <td>' . Types::findType($institution->type)['name'] . '</td>
        //                 <td>' . $institution->status_label . '</td>
        //                 <td>' . FA::icon('caret-down', ['onclick' => 'onClickRowInstitution(this)']) . '</td>
        //             </tr>
        //         </tbody>
        //         ';
        //     }
        //     echo ' 
        //         </table>
        //     ';
        // } else {
        //     echo '<h3>Please Add Specialization</h3>';
        // }
        $html = ob_get_clean();
        return $html;
    }
    public function run()
    {
        return Html::decode($this->html);
    }
}
