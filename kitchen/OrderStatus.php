<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Модель класса для таблицы order_statuses
 * 
 * @property integer     $id
 * @property string      $name
 * @property string      $comment
 */
class OrderStatus extends \yii\db\ActiveRecord
{
    const STATUS_IN_WORK = 1;   // Статус заказа, когда он в работе
    const STATUS_DONE = 2;      // Статус заказа, когда он выполнен

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_statuses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 8],
            [['name'], 'required',],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' =>         Yii::t('app', 'ID'),
            'name' =>       Yii::t('app', 'Статус'),
        ];
    }

    /**
     * Возвращает массив статусов
     * 
     * @return \yii\db\ActiveQuery
     */
    public static function getListOrderStatuses()
    {
        $models = OrderStatus::find()
            ->select(['id', 'name'])
            ->asArray()
            ->all();

        return ArrayHelper::map($models, 'id', 'name');
    }
}
