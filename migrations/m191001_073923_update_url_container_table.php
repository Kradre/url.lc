<?php

use yii\db\Migration;

/**
 * Class m191001_073923_update_url_container_table
 */
class m191001_073923_update_url_container_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('url_container','full_url',$this->text()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('url_container','full_url',$this->string()->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191001_073923_update_url_container_table cannot be reverted.\n";

        return false;
    }
    */
}
