<?php

namespace backend\controllers;

use common\models\Specializations;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\widgets\ActiveForm;

/**
 * Site controller
 */
class SpecializationsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'add-form'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    // public function actionColleges()
    // {
    //     ob_start();
    //     $id = get('id');
    //     echo '<td colspan="6">';
    //     echo '<div class="colleges-grid">';
    //     echo '
    //     <div class="d-flex">
    //         <h5 class="mb-0 align-self-center">Colleges Grid</h5>
    //         <button type="button" class="btn shadow-none border-0 ms-auto" data-bs-toggle="modal" data-bs-target="#helper-modal" data-institution="' . $id . '" onclick="addCollegeForm(this)">' . FA::icon('plus') . '</button>
    //     </div>
    //     ';
    //     echo CollegesGrid::widget(['institution' => $id]);
    //     echo '</div>';
    //     echo '</td>';
    //     $html = ob_get_clean();
    //     return $html;
    // }
    public function actionAddForm()
    {
        ob_start();
        $id = get('id');
        $specializationsModal = new Specializations();
        $form = ActiveForm::begin([
            'action' => Url::toRoute(['specializations/add']),
            'id' => 'add-specializations-form',
            'options' => ['class' => 'add-specializations-form form-horizontal'],
        ]);
        echo '<h3 class="form-title">Add Specialization</h3>';
        echo $form->field($specializationsModal, 'college_id')->hiddenInput(['value' => $id])->label(false);
        echo $form->field($specializationsModal, 'name')->label(false)->textInput(['placeholder' => 'Name']);
        echo Html::submitButton('Add', ['class' => 'btn btn-primary mt-2']);
        ActiveForm::end();
        $html = ob_get_clean();
        return $html;
    }
    // public function actionAdd()
    // {
    //     if (isPost()) {
    //         $specializations = new Specializations();
    //         if ($specializations->load(post())) {
    //             if ($specializations->save()) {
    //                 setFlash('success', 'Specialization Saved Successfly');
    //             } else {
    //                 setFlash('error', 'Specialization Not Saved!!');
    //             }
    //         }
    //     }
    //     return $this->redirect(Url::toRoute(['institutions/index']));
    // }
    // public function actionEditForm()
    // {
    //     ob_start();
    //     $id = get('id');
    //     $collegesModal = Colleges::findOne($id);
    //     $form = ActiveForm::begin([
    //         'action' => Url::toRoute(['colleges/edit', 'id' => $id]),
    //         'id' => 'edit-college-form',
    //         'enableAjaxValidation' => true,
    //         'options' => ['class' => 'edit-college-form form-horizontal'],
    //     ]);
    //     echo '<h3 class="form-title">Edit College</h3>';
    //     echo $form->field($collegesModal, 'name')->label(false)->textInput(['placeholder' => 'Name']);
    //     echo '<div class="form-check form-switch">';
    //     echo $form->field($collegesModal, 'status')->checkbox(['class' => 'form-check-input']);
    //     echo '</div>';
    //     echo Html::submitButton('Edit', ['class' => 'btn btn-primary mt-2']);
    //     ActiveForm::end();
    //     $html = ob_get_clean();
    //     return $html;
    // }
    // public function actionEdit($id)
    // {
    //     $college = Colleges::findOne($id);
    //     if (isPost()) {
    //         $college->load(post());
    //         if ($college->save()) {
    //             setFlash('success', 'College Saved');
    //         } else {
    //             setFlash('error', 'Some thing wrong');
    //         }
    //     }
    //     return $this->redirect(Url::toRoute(['institutions/index', 'gridIndex' => $college->institution_id]));
    // }
    // public function actionDelete()
    // {
    //     $id = get('id');
    //     $college = Colleges::findOne($id);
    //     $gridIndex = $college->institution_id;
    //     if ($college->delete()) {
    //         setFlash('success', 'College Deleted');
    //     } else {
    //         setFlash('error', 'Some Thing Wrong');
    //     }
    //     return $this->redirect(Url::toRoute(['institutions/index', 'gridIndex' => $gridIndex]));
    // }
    // public function actionContentManagement()
    // {
    //     $id = get('id');
    //     $college = Colleges::findOne($id);
    //     if (Types::findType($college->institution->type)['has_specializations']) {
    //         echo SpecializationsGrid::widget(['college' => $id]);
    //     } else {
    //         echo 'render grades grid';
    //     }
    // }
}
