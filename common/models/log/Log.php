<?php
namespace common\models\log;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "log".
 *
 * @property int $id
 * @property string $type
 * @property string $data
 * @property int $userId
 * @property string $createdAt
 */
class Log extends ActiveRecord
{
    //attributes
    const ATTR_ID = 'id';
    const ATTR_TYPE = 'type';
    const ATTR_DATA = 'data';
    const ATTR_USER_ID = 'userId';
    const ATTR_CREATED_AT = 'createdAt';

    //types
    const TYPE_EMPLOYEE_JOB_EXECUTE_EXCEPTION = 'employeeJobExecuteException';
    const TYPE_APP = 'app';

    /**
     * @var string
     */
   const TYPE = self::TYPE_APP;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[static::ATTR_TYPE, static::ATTR_DATA], 'required'],
            [[static::ATTR_DATA], 'string'],
            [[static::ATTR_USER_ID], 'integer'],
            [[static::ATTR_CREATED_AT], 'safe'],
            [[static::ATTR_TYPE], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            static::ATTR_ID => 'ID',
            static::ATTR_TYPE => 'Type',
            static::ATTR_DATA => 'Data',
            static::ATTR_USER_ID => 'User ID',
            static::ATTR_CREATED_AT => 'Created At',
        ];
    }

    /**
     * @param $data
     * @param null $userId
     * @return bool
     */
    public static function add($data, $userId = null)
    {
        if (is_array($data)) {
            $data = json_encode($data);
        } else if (is_object($data)) {
            $data = serialize($data);
        }

        return (new static([
            'data' => $data,
            'userId' => $userId,
            'type' => static::TYPE,
        ]))->save();
    }
}
