<?php

use common\models\User;
use rest\common\controllers\EmployeeController;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-rest',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'rest\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['*']
        ],
        'v1' => [
            'class' => 'rest\modules\v1\Api',
        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => User::class,
            'enableSession' => false,
        ],
        'request' => [
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'response' => [
            'format' => yii\web\Response::FORMAT_JSON,
            'charset' => 'UTF-8',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'rules' => [
                [
                    'class' => \yii\rest\UrlRule::class,
                    'controller' => [
                        'v1/employee',
                    ],
                    'extraPatterns' => [
                        'GET' => EmployeeController::ACTION_INDEX,
                        'POST' => EmployeeController::ACTION_CREATE,
                        'OPTIONS' => EmployeeController::ACTION_OPTIONS,
                    ],
                ],
            ],
        ],
    ],
    'params' => $params,
];
