<?php

use yii\db\Migration;

/**
 * Class m210322_054404_create_table_student
 */
class m210322_054404_create_table_student extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("student", [
            "nisn" => $this->primaryKey(),
            "nis" => $this->integer(),
            "nama" => $this->text(),
            "password" => $this->text(),
            "id_kelas" => $this->integer(),
            "id_skill" => $this->integer(),
            "alamat" => $this->text(),
            "no_telp" => $this->text(),
            "id_spp" => $this->integer(),
            "created_at" => $this->timestamp()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210322_054404_create_table_student cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210322_054404_create_table_student cannot be reverted.\n";

        return false;
    }
    */
}
