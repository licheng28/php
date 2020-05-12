<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "csgo".
 *
 * @property int $id
 * @property string $name
 * @property string $img
 * @property int $category
 * @property string $appearance
 * @property string $type
 * @property int $price_ig
 * @property int $item_id_ig
 * @property int $price_c5
 * @property int $item_id_c5
 * @property int $purchase_c5
 * @property int $c5_id
 * @property int $price_buff
 * @property int $item_id_buff
 * @property int $is_sell
 * @property int $create_time
 * @property int $update_time
 * @property int $sign
 */
class Csgo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'csgo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'img', 'appearance', 'create_time', 'update_time'], 'required'],
            [['category', 'price_ig', 'item_id_ig', 'price_c5', 'item_id_c5', 'purchase_c5', 'c5_id', 'price_buff', 'item_id_buff', 'is_sell', 'create_time', 'update_time', 'sign'], 'integer'],
            [['name', 'img', 'appearance', 'type'], 'string', 'max' => 255],
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
            'img' => 'Img',
            'category' => 'Category',
            'appearance' => 'Appearance',
            'type' => 'Type',
            'price_ig' => 'Price Ig',
            'item_id_ig' => 'Item Id Ig',
            'price_c5' => 'Price C5',
            'item_id_c5' => 'Item Id C5',
            'purchase_c5' => 'Purchase C5',
            'c5_id' => 'C5 ID',
            'price_buff' => 'Price Buff',
            'item_id_buff' => 'Item Id Buff',
            'is_sell' => 'Is Sell',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'sign' => 'Sign',
        ];
    }
}
