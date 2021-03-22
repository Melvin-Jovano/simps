<?php

use yii\db\Migration;

/**
 * Class m210322_052805_create_table_shortcut
 */
class m210322_052805_create_table_skill extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("skill", [
            "id" => $this->primaryKey(),
            "skill" => $this->text(),
            "alias" => $this->text()
        ]);

        $this->insert("skill", [
            "skill" => "Rekayasa Perangkat Lunak",
            "alias" => "RPL",
        ]);

        $this->insert("skill", [
            "skill" => "Teknik Jaringan Komputer",
            "alias" => "TKJ",
        ]);

        $this->insert("skill", [
            "skill" => "Pekerja Sosial",
            "alias" => "PS",
        ]);

        $this->insert("skill", [
            "skill" => "Multimedia",
            "alias" => "MM",
        ]);

        $this->insert("skill", [
            "skill" => "Animasi",
            "alias" => "Animasi",
        ]);

        $this->insert("skill", [
            "skill" => "Desain Komunikasi Visual",
            "alias" => "DKV",
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210322_052805_create_table_shortcut cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210322_052805_create_table_shortcut cannot be reverted.\n";

        return false;
    }
    */
}
