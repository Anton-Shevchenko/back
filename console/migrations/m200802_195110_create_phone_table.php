<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%phone}}`.
 */
class m200802_195110_create_phone_table extends Migration
{
    const TABLE_NAME = '{{%phone}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey()->unsigned(),
            'employeeId' => $this->integer()->unsigned()->notNull(),
            'phone' => $this->string(),
        ]);

        $this->createIndex('idxPhoneEmployeeId', self::TABLE_NAME, 'employeeId');

        $this->addForeignKey(
            'FkPhoneEmployeeId',
            '{{%phone}}',
            'employeeId',
            '{{employee}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FkPhoneEmployeeId', '{{%employee}}');
        $this->dropTable(self::TABLE_NAME);
    }
}
