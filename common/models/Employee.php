<?php
namespace common\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property string|null $firstName
 * @property string|null $lastName
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstName', 'lastName'], 'string', 'max' => 255],
        ];
    }

    public function fields()
    {
        return [
            'id',
            'firstName',
            'lastName',
            'phones'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhones()
    {
        return $this->hasMany(Phone::class, ['employeeId' => 'id'])->select('phone')->column();
    }
}
