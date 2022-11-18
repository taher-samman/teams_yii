<?php

namespace common\components;

use common\models\Colleges;
use common\models\Types;
use rmrevin\yii\fontawesome\FA;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

class CollegesGrid extends Widget
{
    public $html;
    public $institution;
    public function init()
    {
        parent::init();
        $this->html = $this->renderGrid();
    }
    public function renderGrid()
    {
        ob_start();
        $colleges = Colleges::find()->where(['institution_id' => $this->institution])->all();
        if (count($colleges) > 0) {
            echo '
            <table class="table-colleges w-100">';
            foreach ($colleges as $college) {
                echo '
                <tbody data-college="' . $college->id . '">
                    <tr>
                        <th scope="row"  class="text-center">' . $college->id . '</th>
                        <td class="text-center">' . $college->name . '</td>
                        <td class="text-center">' . $college->status_label . '</td>
                        <td class="text-center"><div class="actions">
                        ' . Html::a(FA::icon('trash'), Url::to(['colleges/delete', 'id' => $college->id]), ['data-confirm' => 'are you sure!']) . '
                        <button type="button" class="btn shadow-none border-0 ms-auto" data-bs-toggle="modal" data-bs-target="#helper-modal" data-college="' . $college->id . '" onclick="editCollegeForm(this)">' . FA::icon('pencil') . '</button>
                       </div> </td>';
                if (Types::findType($college->institution->type)['has_specializations']) {
                    echo '
                    <td class="text-end">
                        <button type="button" data-college="' . $college->id . '" onclick="manageCollegesContent(this)" data-bs-toggle="offcanvas" class="btn btn-primary" data-bs-target="#helper-offcanvas" aria-controls="helper-offcanvas" 0="">Manage Specializations</button>
                    </td>';
                } else {
                    echo '
                    <td class="text-end">
                        <button type="button" data-college="' . $college->id . '" onclick="manageCollegesContent(this)" data-bs-toggle="offcanvas" class="btn btn-primary" data-bs-target="#helper-offcanvas" aria-controls="helper-offcanvas" 0="">Manage Grades</button>
                    </td>';
                }
                echo '</tr>
                </tbody>
                ';
            }
            echo ' 
                </table>
            ';
        } else {
            echo '<h3>Please Add College</h3>';
        }
        $html = ob_get_clean();
        return $html;
    }
    public function run()
    {
        return Html::decode($this->html);
    }
}
