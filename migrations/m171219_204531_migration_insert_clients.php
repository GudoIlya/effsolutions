<?php

use yii\db\Migration;

/**
 * Class m171219_204531_migration_insert_clients
 */
class m171219_204531_migration_insert_clients extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert('clients',array(
         'client_name'=>'Федор',
          ));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171219_204531_migration_insert_clients cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171219_204531_migration_insert_clients cannot be reverted.\n";

        return false;
    }
    */
}
