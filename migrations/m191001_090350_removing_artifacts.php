<?php

use yii\db\Migration;

/**
 * Class m191001_090350_removing_artifacts
 */
class m191001_090350_removing_artifacts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191001_090350_removing_artifacts cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191001_090350_removing_artifacts cannot be reverted.\n";

        return false;
    }
    */
}
