<?php
namespace common\models;

use Yii;

/**
 * This is the model class for table "phone".
 *
 * @property int $id
 * @property int $employeeId
 * @property string $phone
 */
class Phone extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'phone';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employeeId', 'phone'], 'required'],
            [['employeeId'], 'integer'],
            [['phone'], 'string', 'max' => 255],
        ];
    }

    public function fields()
    {
        return [
            'phone'
        ];
    }
}
