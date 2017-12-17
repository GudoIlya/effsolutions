<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cities`.
 */
class m171216_180000_create_cities_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cities', [
            'id' => $this->primaryKey(),
            'city_name' => $this->string()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('cities');
    }
}
