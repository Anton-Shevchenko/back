<?php
namespace rest\common\models\views\Employee;

use common\models\Employee;
use yii\base\Model;
use yii\db\ActiveQuery;
use yii\data\ActiveDataProvider;
use Yii;
use yii\db\Expression;

/**
 * Class EmployeeSearchForm
 */
class EmployeeSearchForm extends Model
{
    /** @var string */
    public $fullName;

    /** @var integer */
    public $id;

    public function rules()
    {
        return [
            [['fullName', 'id'], 'string'],
        ];
    }

    public function search()
    {
        $query = Employee::find();

        $this->bindFilters($query);

        $provider = Yii::createObject([
            'class' => ActiveDataProvider::class,
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'fullName',
                    'id'
                ],
                'defaultOrder' => [
                    'id'=> SORT_DESC,
                ],
            ],
            'pagination' => [
                'defaultPageSize' => 100
            ]
        ]);

        return $provider->getModels();
    }

    private function bindFilters(ActiveQuery $query)
    {
        $query->andFilterWhere([
            'like',
            new Expression("concat_ws(' ', firstName, lastName)"), $this->fullName
        ]);
    }
}
