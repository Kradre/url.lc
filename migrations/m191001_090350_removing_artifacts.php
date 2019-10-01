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
        $this->dropColumn('url_container','cookie_key');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('url_container','cookie_key',$this->string()->notNull());
    }

}
