<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "spp".
 *
 * @property int $id
 * @property string $nominal
 * @property string $created_at
 */
class Spp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'spp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nominal'], 'required', 'message' => 'Nominal Tidak Boleh Kosong'],
            [['nominal'], 'number', 'message' => 'Nominal Harus Nomor'],
            [['id'], 'integer'],
            [['nominal'], 'string'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nominal' => 'Nominal',
            'created_at' => 'Created At',
        ];
    }
}
