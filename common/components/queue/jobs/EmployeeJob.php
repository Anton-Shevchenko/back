<?php
namespace common\components\queue\jobs;

use common\models\Employee;
use common\models\log\EmployeeJobException;
use yii\base\BaseObject;
use yii\queue\JobInterface;

/**
 * Class EmployeeJob
 * @package common\components\queue
 */
class EmployeeJob extends BaseObject implements JobInterface
{
    /** @var Employee */
    private $employee;

    /**
     * @var string|EmployeeJob
     */
    private $className;

    public function __construct($employee, $config = [])
    {
        parent::__construct($config);
        $this->employee = $employee;
    }

    /**
     * @param \yii\queue\Queue $queue
     * @return mixed|void
     * @throws /Throwable
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function execute($queue)
    {
        try {
            $this->employee->create();
        } catch (\Throwable $exception) {
            $data = [
                'notify' => $this->notificationId,
                'exception' => $exception->getMessage(),
            ];
            EmployeeJobException::add($data);
        }
    }
}
