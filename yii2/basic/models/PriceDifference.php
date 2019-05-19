<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "price_difference".
 *
 * @property int $id
 * @property string $name
 * @property int $item_id_igxe
 * @property string $price_igxe
 * @property int $item_id_c5
 * @property string $price_c5
 * @property int $update_time
 * @property int $creat_time
 * @property string $difference
 */
class PriceDifference extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'price_difference';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'update_time', 'creat_time'], 'required'],
            [['item_id_igxe', 'item_id_c5', 'update_time', 'creat_time'], 'integer'],
            [['name', 'difference'], 'string', 'max' => 255],
            [['price_igxe', 'price_c5'], 'string', 'max' => 9],
            [['item_id_igxe'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'item_id_igxe' => 'igxe_id',
            'price_igxe' => 'ig价格',
            'item_id_c5' => 'c5_id',
            'price_c5' => 'c5价格',
            'update_time' => '更新时间',
            'creat_time' => '创建时间',
            'difference' => '差价',
        ];
    }
}
