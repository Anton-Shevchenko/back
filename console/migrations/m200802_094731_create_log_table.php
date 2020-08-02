<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%log}}`.
 */
class m200802_094731_create_log_table extends Migration
{
    const TABLE_NAME = '{{%log}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey()->unsigned(),
            'type' => $this->string(255)->notNull(),
            'data' => $this->text()->notNull(),
            'userId' => $this->integer()->unsigned()->null(),
            'createdAt' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
