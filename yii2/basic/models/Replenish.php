<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "replenish".
 *
 * @property int $id
 * @property int $item_id_igxe
 * @property int $sell_day
 * @property int $creat_time
 * @property int $status
 * @property int $fee
 * @property int $income_price
 * @property int $sold_time
 */
class Replenish extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'replenish';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id_igxe', 'sell_day', 'creat_time', 'fee', 'income_price', 'sold_time'], 'required'],
            [['item_id_igxe', 'sell_day', 'creat_time', 'status', 'fee', 'income_price', 'sold_time'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_id_igxe' => 'Item Id Igxe',
            'sell_day' => 'Sell Day',
            'creat_time' => 'Creat Time',
            'status' => 'Status',
            'fee' => 'Fee',
            'income_price' => 'Income Price',
            'sold_time' => 'Sold Time',
        ];
    }
}
