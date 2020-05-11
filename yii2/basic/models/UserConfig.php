<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_config".
 *
 * @property int $id
 * @property int $user_id
 * @property string $cookie
 * @property string $pwd
 * @property string $web
 */
class UserConfig extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_config';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'web'], 'required'],
            [['user_id'], 'integer'],
            [['pwd', 'web'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'cookie' => 'Cookie',
            'pwd' => 'Pwd',
            'web' => 'Web',
        ];
    }
}
