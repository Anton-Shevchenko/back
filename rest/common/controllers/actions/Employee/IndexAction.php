<?php
namespace rest\common\controllers\actions\Employee;

use common\models\Employee;
use common\models\log\Log;
use rest\common\models\views\Employee\EmployeeSearchForm;
use rest\components\api\actions\Action;


/**
 * Class IndexAction
 */
class IndexAction extends Action
{
    /**
     * @return null|Employee
     */
    public function run()
    {
        $searchForm = new EmployeeSearchForm();
        $searchForm->setAttributes($this->request->getQueryParams());
        if (!$searchForm->validate()) {
            return $searchForm;
        }

        return $searchForm->search();
    }
}
