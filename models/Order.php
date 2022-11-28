<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "orders".
 *
 * @property int|null $id
 * @property int|null $real_id
 * @property string|null $user_name
 * @property string|null $user_phone
 * @property int|null $warehouse_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $status
 * @property int|null $items_count
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => false,
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression("datetime('now')"),
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'real_id', 'warehouse_id', 'status', 'items_count'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['user_name'], 'string', 'max' => 255],
            [['user_phone'], 'string', 'max' => 12],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'real_id' => 'Real ID',
            'user_name' => 'User Name',
            'user_phone' => 'User Phone',
            'warehouse_id' => 'Warehouse ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
            'items_count' => 'Items Count',
        ];
    }
}
