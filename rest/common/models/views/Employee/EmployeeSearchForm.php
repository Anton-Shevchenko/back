<?php
namespace rest\common\models\views\Employee;

use common\models\Employee;
use yii\base\Model;
use yii\db\ActiveQuery;
use yii\data\ActiveDataProvider;
use Yii;

/**
 * Class EmployeeSearchForm
 */
class EmployeeSearchForm extends Model
{
    /** @var string */
    public $lastName;

    public function rules(): array
    {
        return [
            [['lastName'], 'string'],
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
                    'lastName',
                ],
                'defaultOrder' => [
                    'lastName' => SORT_ASC,
                ],
            ],
            'pagination' => [
                'defaultPageSize' => 10
            ]
        ]);

        return $provider->getModels();
    }

    private function bindFilters(ActiveQuery $query)
    {
        $query->andFilterWhere(['like', Employee::tableName() . '.lastName', $this->lastName]);
    }
}
