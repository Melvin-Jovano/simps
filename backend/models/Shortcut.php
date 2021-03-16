<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "shortcut".
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property int $level
 */
class Shortcut extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shortcut';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'url', 'level'], 'required'],
            [['name', 'url'], 'string'],
            [['level'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'url' => 'Url',
            'level' => 'Level',
        ];
    }
}
