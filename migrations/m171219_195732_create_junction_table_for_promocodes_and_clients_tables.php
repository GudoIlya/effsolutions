<?php

use yii\db\Migration;

/**
 * Handles the creation of table `promocodes_clients`.
 * Has foreign keys to the tables:
 *
 * - `promocodes`
 * - `clients`
 */
class m171219_195732_create_junction_table_for_promocodes_and_clients_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('promocodes_clients', [
            'promocodes_id' => $this->integer(),
            'clients_id' => $this->integer(),
            'PRIMARY KEY(promocodes_id, clients_id)',
        ]);

        // creates index for column `promocodes_id`
        $this->createIndex(
            'idx-promocodes_clients-promocodes_id',
            'promocodes_clients',
            'promocodes_id'
        );

        // add foreign key for table `promocodes`
        $this->addForeignKey(
            'fk-promocodes_clients-promocodes_id',
            'promocodes_clients',
            'promocodes_id',
            'promocodes',
            'id',
            'CASCADE'
        );

        // creates index for column `clients_id`
        $this->createIndex(
            'idx-promocodes_clients-clients_id',
            'promocodes_clients',
            'clients_id'
        );

        // add foreign key for table `clients`
        $this->addForeignKey(
            'fk-promocodes_clients-clients_id',
            'promocodes_clients',
            'clients_id',
            'clients',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `promocodes`
        $this->dropForeignKey(
            'fk-promocodes_clients-promocodes_id',
            'promocodes_clients'
        );

        // drops index for column `promocodes_id`
        $this->dropIndex(
            'idx-promocodes_clients-promocodes_id',
            'promocodes_clients'
        );

        // drops foreign key for table `clients`
        $this->dropForeignKey(
            'fk-promocodes_clients-clients_id',
            'promocodes_clients'
        );

        // drops index for column `clients_id`
        $this->dropIndex(
            'idx-promocodes_clients-clients_id',
            'promocodes_clients'
        );

        $this->dropTable('promocodes_clients');
    }
}
