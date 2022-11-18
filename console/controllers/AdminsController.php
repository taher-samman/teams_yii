<?php

namespace console\controllers;

use yii\console\Controller;
use console\models\SignupForm;

class AdminsController extends Controller
{
    public $username;
    public $email;
    public $password;
    public function options($actionID)
    {
        return ['username', 'email', 'password'];
    }

    public function optionAliases()
    {
        return ['u' => 'username', 'e' => 'email', 'p' => 'password'];
    }
    public function actionCreate()
    {
        // ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
        // cmd example :: php yii admins/create -e=admin@codendot.com -u=admin -p=admin123 ::
        // ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

        $model = new SignupForm();
        $model->username = $this->username;
        $model->email = $this->email;
        $model->password = $this->password;
        if ($model->signup()) {
            echo 'Succes!!';
            return;
        } else {
            echo 'Failed!!';
            return;
        }
    }
}
