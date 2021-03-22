<?php

use yii\db\Migration;

/**
 * Class m210322_054839_create_table_petugas
 */
class m210322_054839_create_table_petugas extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("petugas", [
            "id" => $this->primaryKey(),
            "username" => $this->text(),    
            "password" => $this->text(),
            "nama_petugas" => $this->text(),
            "level" => "ENUM('1', '2')",
        ]);

        $this->insert("petugas", [
            "username" => "admin",
            "password" => Yii::$app->security->generatePasswordHash("admin"),
            "nama_petugas" => "administrator",
            "level" => '2',
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210322_054839_create_table_petugas cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210322_054839_create_table_petugas cannot be reverted.\n";

        return false;
    }
    */
}
