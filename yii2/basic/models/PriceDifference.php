<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "price_difference".
 *
 * @property int $id
 * @property string $name
 * @property int $item_id_igxe
 * @property int $price_igxe
 * @property int $item_id_c5
 * @property int $price_c5
 * @property int $purchase_c5
 * @property string $img
 * @property int $price_buff
 * @property int $item_id_buff
 * @property int $update_time
 * @property int $creat_time
 * @property int $difference
 * @property int $is_sell
 * @property int $c5_id
 * @property int $type
 * @property int $appid
 * @property string $sell_time
 */
class PriceDifference extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const TYPE_BUNDLE = 1;
    const TYPE_UNIQUE = 2;
    const TYPE_GENUINE = 3;
    const TYPE_DEFAULT = 0;
    const TYPE_IMMORTAL = 4;
    const TYPE_H1Z1 = 5;

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
            [['name'], 'trim'],
            [['item_id_igxe', 'price_igxe', 'item_id_c5', 'price_c5', 'price_buff', 'update_time', 'creat_time', 'difference', 'is_sell', 'c5_id', 'type','purchase_c5', 'appid', 'item_id_buff'], 'integer'],
            [['name', 'img', 'sell_time'], 'string', 'max' => 255],
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
            'item_id_igxe' => 'IGID',
            'price_igxe' => 'ig价格',
            'item_id_c5' => 'C5ID',
            'price_c5' => 'c5价格',
            'purchase_c5' => 'C5求购',
            'img' => '图片',
            'price_buff' => 'buff',
            'item_id_buff' => 'buffid',
            'update_time' => '更新时间',
            'creat_time' => '创建时间',
            'difference' => '差价',
            'is_sell' => '在售',
            'c5_id' => 'c5item主键id',
            'type' => '类型',
            'appid' => '游戏',
            'sell_time' => '售卖时间'
        ];
    }

    public function getSellMsg($k)
    {

        if($k === null){

            return '-';

        }

        $arr = [

            0 => '否',
            1 => '是',
            2 => '-',

        ];

        return $arr[$k];

    }
}
