<?php

use app\models\OrderStatus;
use yii\db\Migration;

/**
 * Class m230519_232625_create_table_orders
 */
class m230519_232625_create_table_orders extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->null()->defaultValue(null),
            'created_at' => $this->string(50)->null()->defaultValue(null),
            'updated_at' => $this->string(50)->null()->defaultValue(null),
            'status_id' => $this->integer()->null()->defaultValue(OrderStatus::STATUS_IN_WORK),
        ]);
        $this->execute("ALTER TABLE orders COMMENT 'Таблица сведений о заказах';");
        $this->addCommentOnColumn('{{%orders}}', 'id', 'Идентификатор записи в таблице');
        $this->addCommentOnColumn('{{%orders}}', 'name', 'Название заказа');
        $this->addCommentOnColumn('{{%orders}}', 'created_at', 'Дата и время создания записи в таблице');
        $this->addCommentOnColumn('{{%orders}}', 'updated_at', 'Дата и время последнего изменения записи в таблице');
        $this->addCommentOnColumn('{{%orders}}', 'status_id', 'Идентификатор статуса заказа');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%orders}}');
    }
}
