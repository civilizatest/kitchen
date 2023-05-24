<?php

use yii\db\Migration;

/**
 * Class m230519_232607_create_table_order_statuses
 */
class m230519_232607_create_table_order_statuses extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_statuses}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(8)->null()->defaultValue(null),
        ]);
        $this->execute("ALTER TABLE order_statuses COMMENT 'Таблица сведений о статусах заказов';");
        $this->addCommentOnColumn('{{%order_statuses}}', 'id', 'Идентификатор записи в таблице');
        $this->addCommentOnColumn('{{%order_statuses}}', 'name', 'Название заказа');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order_statuses}}');
    }
}
