<?php

use yii\db\Migration;

/**
 * Class m210322_050727_create_table_class
 */
class m210322_050727_create_table_class extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("class", [
            "id" => $this->primaryKey(),
            "class" => $this->text()
        ]);

        $this->insert("class", [
            'class' => 'X',
        ]);

        $this->insert("class", [
            'class' => 'XI',
        ]);

        $this->insert("class", [
            'class' => 'XII',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210322_050727_create_table_class cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210322_050727_create_table_class cannot be reverted.\n";

        return false;
    }
    */
}
