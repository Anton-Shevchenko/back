<?php
namespace rest\common\models\views\Employee;

use common\models\Employee;
use common\models\Phone;
use yii\base\Model;

class CreateForm extends Model
{
    /** @var string */
    public $firstName;

    /** @var string */
    public $lastName;

    /** @var array */
    public $phoneNumbers;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['firstName', 'lastName'], 'string', 'max' => 100],
            [['phoneNumbers'],  'each', 'rule' => ['string']],
        ];
    }

    /**
     * @return Employee
     * @throws ModelSaveException
     */
    public function create(): Employee
    {
        $employee = new Employee();
        $employee->firstName = $this->firstName;
        $employee->lastName = $this->lastName;

        $transaction = \Yii::$app->db->beginTransaction();
        try {
            if (!$employee->save()) {
                return $employee;
            }

            if (!empty($this->phoneNumbers)) {
                foreach ($this->phoneNumbers as $phoneNumber) {
                    $this->createPhoneNumber($phoneNumber, $employee);
                }
            }
            $transaction->commit();
        } catch (\Throwable $exception) {
            $transaction->rollBack();
            throw $exception;
        }

        return $employee;
    }

    private function createPhoneNumber($phoneNumber, $employee)
    {
        $phone = new Phone([
            'phone' => $phoneNumber,
            'employeeId' => $employee->id
        ]);

        if (!$phone->save()) {
            $attr = array_key_first($phone->errors);
            $this->addError($attr, $phone->errors[$attr][0]);
        }
    }
}