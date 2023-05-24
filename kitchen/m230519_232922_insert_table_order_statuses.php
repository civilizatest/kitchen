<?php

use yii\db\Migration;

/**
 * Class m230519_232922_insert_table_order_statuses
 */
class m230519_232922_insert_table_order_statuses extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%order_statuses}}', [
            'name' => 'В работе',
        ]);
        $this->insert('{{%order_statuses}}', [
            'name' => 'Выполнен',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('{{%order_statuses}}');
    }
}
