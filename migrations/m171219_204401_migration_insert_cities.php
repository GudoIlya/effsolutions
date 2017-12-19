<?php

use yii\db\Migration;

/**
 * Class m171219_204401_migration_insert_cities
 */
class m171219_204401_migration_insert_cities extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert('cities',array(
         'city_name'=>'Губкин',
          ));
        $this->insert('cities',array(
         'city_name'=>'Воронеж',
          ));
        $this->insert('cities',array(
         'city_name'=>'Старый Оскол',
          ));
        $this->insert('cities',array(
         'city_name'=>'Белгород',
          ));
        $this->insert('cities',array(
         'city_name'=>'Курск',
          ));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171219_204401_migration_insert_cities cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171219_204401_migration_insert_cities cannot be reverted.\n";

        return false;
    }
    */
}
