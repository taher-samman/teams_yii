<?php

namespace backend\controllers;

use common\models\Institutions;
use common\models\Types;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\widgets\ActiveForm;

/**
 * Site controller
 */
class InstitutionsController extends Controller
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
                        'actions' => ['logout', 'index', 'delete', 'add', 'edit-form', 'edit'],
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
        $gridIndex = get('gridIndex') ? get('gridIndex') : 0;
        return $this->render('index', ['gridIndex' => $gridIndex]);
    }
    public function actionAdd()
    {
        if (isPost()) {
            $institutionsModel = new Institutions();
            if ($institutionsModel->load(post())) {
                if ($institutionsModel->save()) {
                    return $this->redirect(Url::toRoute(['institutions/index', 'gridIndex' => $institutionsModel->id]));
                } else {
                    setFlash('error', 'Institution Not Saved!!');
                }
            }
        }
        return $this->redirect(Url::toRoute(['institutions/index']));
    }
    public function actionDelete()
    {
        $id = get('id');
        $institution = Institutions::findOne($id);
        if ($institution->delete()) {
            setFlash('success', 'Institution Deleted');
        } else {
            setFlash('error', 'Some Thing Wrong');
        }
        return $this->redirect(Url::toRoute(['institutions/index']));
    }
    public function actionEditForm()
    {
        ob_start();
        $id = get('id');
        $institutionsModel = Institutions::findOne($id);
        $form = ActiveForm::begin([
            'action' => Url::toRoute(['institutions/edit', 'id' => $id]),
            'id' => 'edit-institution-form',
            'options' => ['class' => 'edit-institution-form form-horizontal'],
        ]);
        echo '<h3 class="form-title">Edit Institution</h3>';
        echo $form->field($institutionsModel, 'name')->label(false)->textInput(['placeholder' => 'Name']);
        echo '<div class="form-check form-switch">';
        echo $form->field($institutionsModel, 'status')->checkbox(['class' => 'form-check-input']);
        echo '</div>';
        echo $form->field($institutionsModel, 'type')->dropDownList(Types::getTypes(), ['prompt' => 'Select Type', 'class' => 'form-control mt-2'])->label(false);

        echo Html::submitButton('Edit', ['class' => 'btn btn-primary mt-2']);
        ActiveForm::end();
        $html = ob_get_clean();
        return $html;
    }
    public function actionEdit($id)
    {
        $institution = Institutions::findOne($id);
        if (isPost()) {
            $institution->load(post());
            if ($institution->save()) {
                setFlash('success', 'Institution Saved');
            } else {
                setFlash('error', 'Some thing wrong');
            }
        }
        return $this->redirect(Url::toRoute(['institutions/index', 'gridIndex' => $institution->id]));
    }
}
