<?php
namespace rest\common\controllers\actions\Employee;

use common\components\queue\jobs\EmployeeJob;
use rest\common\models\views\Employee\CreateForm;
use rest\components\api\actions\Action;

/**
 * Class CreateAction
 */
class CreateAction extends Action
{
    public function run()
    {
        $model = new CreateForm();
        $model->setAttributes(\Yii::$app->request->post());
        if (!$model->validate()) {
            return $model;
        }
        \Yii::$app->queue->push(new EmployeeJob($model));
        $this->response->setStatusCode(204);
    }
}
