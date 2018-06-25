<?php

use yii\db\Migration;

/**
 * Class m180625_110406_basetables
 */
class m180625_110406_basetables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%userauth_user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(80)->unique()->notNull(),
            'password' => $this->string(60)->notNull(),
            'password_salt' => $this->string(32)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%userauth_user}}');
    }
}
