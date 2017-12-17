<?php

use yii\db\Migration;

/**
 * Handles the creation of table `promocodes`.
 */
class m171216_183413_create_promocodes_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('promocodes', [
            'id' => $this->primaryKey(),
            'begin_date' => $this->date(),
            'end_date'   => $this->date(),
            'city_id'    => $this->integer()->notNull(),
            'promocode'  => $this->string()->unique(),
            'status'     => $this->boolean()->defaultValue(false),
            'compensation'=> $this->decimal(10,2)
        ]);

        $this->addForeignKey(
            'fk-promocodes-cities-id',
            'promocodes',
            'city_id',
            'cities',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('promocodes');
    }
}
