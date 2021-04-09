<?php

use yii\db\Migration;

/**
 * Class m210322_054020_create_table_spp
 */
class m210322_054020_create_table_spp extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("spp", [
            "id" => $this->primaryKey(),
            "nisn" => $this->integer(),
            "nama" => $this->text(),
            "id_kelas" => $this->integer(),
            "id_skill" => $this->integer(),
            "nominal" => $this->text(),
            "created_at" => $this->timestamp()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210322_054020_create_table_spp cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210322_054020_create_table_spp cannot be reverted.\n";

        return false;
    }
    */
}
