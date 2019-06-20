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
 * @property string $purchase_c5
 * @property string $img
 * @property int $price_buff
 * @property int $update_time
 * @property int $creat_time
 * @property int $difference
 * @property int $is_sell
 * @property int $c5_id
 * @property int $type
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
            [['item_id_igxe', 'price_igxe', 'item_id_c5', 'price_c5', 'price_buff', 'update_time', 'creat_time', 'difference', 'is_sell', 'c5_id', 'type'], 'integer'],
            [['name', 'img'], 'string', 'max' => 255],
            [['purchase_c5'], 'string', 'max' => 21],
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
            'price_buff' => 'buff价格',
            'update_time' => '更新时间',
            'creat_time' => '创建时间',
            'difference' => '差价',
            'is_sell' => '在售',
            'c5_id' => 'c5item主键id',
            'type' => '类型'
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
