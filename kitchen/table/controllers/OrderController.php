<?php

namespace app\modules\table\controllers;

use Yii;
use yii\web\Controller;
use app\models\Order;
use app\models\OrderStatus;
use app\modules\table\models\OrderSearch;
use yii\web\NotFoundHttpException;
use Exception;

class OrderController extends Controller
{

    /**
     * Метод показывает список всех заказов
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Метод создаёт новый заказ
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Метод редактирует существующий заказ
     * 
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $order = Order::findOne(['id' => $id]);
        
        if (empty($order)) {
            throw new NotFoundHttpException('Заказа с таким ID не существует.');
        }

        $order_status = OrderStatus::findOne(['id' => $order->status_id]);

        try {
            if ($order->load(Yii::$app->request->post()) && $order->validate()) {
                $order->save();
                return $this->redirect(['index']);
            } else {
                return $this->render('update', [
                    'order' => $order,
                ]);
            }
        } catch (Exception $e) {
            throw new NotFoundHttpException('Изменить запись не удалось.');
        }
    }

    /**
     * Метод удаляет заказ по ID
     * 
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->delete()) {
            return $this->redirect(['index']);
        }
    }

    /**
     * Метод находит заказ по ID
     * 
     * @param integer $id
     * @return mixed
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Заказа с таким ID не существует.');
        }
    }
}
