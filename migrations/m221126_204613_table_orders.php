<?php

use yii\db\Migration;

/**
 * Class m221126_204613_table_orders
 */
class m221126_204613_table_orders extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('orders', [
            "id" => $this->bigPrimaryKey(),
            "real_id" => $this->bigInteger(),
            "user_name" => $this->string(),
            "user_phone" => $this->string(12),
            "warehouse_id" => $this->integer(),
            "created_at" => $this->date(),
            "updated_at" => $this->date(),
            "status" => $this->integer(),
            "items_count" => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('orders');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221126_204613_table_orders cannot be reverted.\n";

        return false;
    }
    */
}
