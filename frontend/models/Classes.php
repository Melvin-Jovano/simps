<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "class".
 *
 * @property int $id
 * @property string $class
 */
class Classes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $nama_petugas;
    
    public static function tableName()
    {
        return 'class';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['class'], 'required'],
            [['class'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'class' => 'Class',
        ];
    }
}
