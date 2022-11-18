<?php

use yii\web\Request;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);
$baseUrl = str_replace('/backend/web', '', (new Request())->getBaseUrl());
return [
    'id' => 'app-backend',
    'name' => 'Teams',
    'basePath' => dirname(__DIR__),
    'language' => 'en-US',
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],

    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            // 'baseUrl' => $baseUrl . '/admin',
        ],
        'user' => [
            'identityClass' => 'common\models\Admin',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend_teams', 'httpOnly' => true],
        ],
        'session' => [
            'name' => 'advanced-backend_teams',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

    ],
    'params' => $params,
];
