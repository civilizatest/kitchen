<?php

namespace app\models;

use Yii;
use app\models\OrderStatus;
use yii\behaviors\TimestampBehavior;

/**
 * Модель класса для таблицы orders
 * 
 * @property integer     $id
 * @property string      $name
 * @property string      $created_at
 * @property string      $updated_at
 * @property integer     $status_id
 */
class Order extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['name'], 'required',],
            [['status_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' =>         Yii::t('app', 'ID'),
            'name' =>       Yii::t('app', 'Название'),
            'created_at' => Yii::t('app', 'Создано'),
            'updated_at' => Yii::t('app', 'Изменено'),
            'status_id' =>  Yii::t('app', 'Статус'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'timestamp' => [
                'class'              => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value'              => \gmdate('Y-m-d H:i:s'),
            ],
        ];
    }

    /**
     * Метод возвращает статус заказа
     * 
     * @return \Yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(OrderStatus::className(), ['id' => 'status_id']);
    }
}
