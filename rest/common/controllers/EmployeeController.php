<?php
namespace rest\common\controllers;

use rest\common\controllers\actions\Employee\IndexAction;
use rest\common\controllers\actions\Employee\CreateAction;
use rest\components\api\Controller;
use yii\helpers\ArrayHelper;
use yii\rest\OptionsAction;

class EmployeeController extends  Controller
{
    const ACTION_INDEX = 'index';
    const ACTION_CREATE = 'create';
    const ACTION_OPTIONS = 'options';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'authenticator' => [
                    'except' => [
                        self::ACTION_INDEX,
                        self::ACTION_OPTIONS,
                        self::ACTION_CREATE,
                    ],
                ],
                'access' => [
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => [
                                self::ACTION_INDEX,
                                self::ACTION_OPTIONS,
                                self::ACTION_CREATE,
                            ],
                            'roles' => ['?'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            self::ACTION_INDEX => [
                'class' => IndexAction::class,
            ],
            self::ACTION_CREATE => [
                'class' => CreateAction::class,
            ],
            self::ACTION_OPTIONS => [
                'class' => OptionsAction::class,
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    protected function verbs()
    {
        return [
            self::ACTION_INDEX => ['GET'],
            self::ACTION_CREATE => ['POST'],
            self::ACTION_OPTIONS => ['OPTIONS'],
        ];
    }
}