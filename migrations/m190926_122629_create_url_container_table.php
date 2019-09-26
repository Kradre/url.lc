<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%url_container}}`.
 */
class m190926_122629_create_url_container_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%url_container}}', [
            'id' => $this->primaryKey(),
            'short_url' => $this->string(7)->unique(),
            'full_url' => $this->string()->notNull(),
            'cookie_key' => $this->string()->notNull()->unique(),
            'created_at' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%url_container}}');
    }
}
