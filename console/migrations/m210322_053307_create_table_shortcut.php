<?php

use yii\db\Migration;

/**
 * Class m210322_053307_create_table_shortcut
 */
class m210322_053307_create_table_shortcut extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("shortcut", [
            "id" => $this->primaryKey(),
            "name" => $this->text(),
            "url" => $this->text(),
            "level" => $this->integer()
        ]);

        $this->insert("shortcut", [
            "name" => "Dashboard",
            "url" => "site/dashboard",
            "level" => 1,
        ]);

        $this->insert("shortcut", [
            "name" => "Pembayaran",
            "url" => "site/billing",
            "level" => 1,
        ]);

        $this->insert("shortcut", [
            "name" => "Dashboard",
            "url" => "site/dashboard",
            "level" => 2,
        ]);

        $this->insert("shortcut", [
            "name" => "Pembayaran",
            "url" => "site/billing",
            "level" => 2,
        ]);

        $this->insert("shortcut", [
            "name" => "Siswa",
            "url" => "student/index",
            "level" => 2,
        ]);

        $this->insert("shortcut", [
            "name" => "Petugas",
            "url" => "petugas/index",
            "level" => 2,
        ]);

        $this->insert("shortcut", [
            "name" => "Kelas",
            "url" => "classes/index",
            "level" => 2,
        ]);

        $this->insert("shortcut", [
            "name" => "Pembayaran",
            "url" => "spp/index",
            "level" => 2,
        ]);

        $this->insert("shortcut", [
            "name" => "Laporan & Riwayat",
            "url" => "site/report",
            "level" => 2,
        ]);

        $this->insert("shortcut", [
            "name" => "Laporan & Riwayat",
            "url" => "site/report",
            "level" => 1,
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210322_053307_create_table_shortcut cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210322_053307_create_table_shortcut cannot be reverted.\n";

        return false;
    }
    */
}
