<?php

use yii\db\Migration;

/**
 * Handles the creation of table `clients`.
 */
class m171219_195424_create_clients_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('clients', [
            'id' => $this->primaryKey(),
            'client_name' => $this->string()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('clients');
    }
}
