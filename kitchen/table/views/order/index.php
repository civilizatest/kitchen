<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use app\models\Order;
use app\models\OrderStatus;
use app\models\OrderSearch;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список заказов';
$this->params['breadcrumbs'][] = $this->title;

$gridColumns = [
    [
        'class'         => 'yii\grid\ActionColumn',
        'template'      => '{update} {delete}',
        'buttons'       => [
            'rbac/assignment/view' => function ($url) {
                return "<a href=" . $url . " title='View'><span class='glyphicon glyphicon-wrench'></span></a>";
            }
        ],
    ],
    [
        'format'    => 'raw',
        'attribute' => 'ID',
        'value'     => function ($data) {
            return $data['id'];
        },
    ],
    [
        'attribute' => 'created_at',
        'label'     => 'Дата создания',
        'filter'    =>  false,
        'value'     => function ($data) {
            return Yii::$app->formatter->asTime($data->created_at, "php:d.m.y");
        }
    ],
    [
        'format'    => 'raw',
        'attribute' => 'name',
        'filter'    =>  true,
        'value'     => function ($data) {
            return $data['name'];
        },
    ],
    [
        'format'    => 'raw',
        'attribute' => 'status_id',
        'filter'    =>  false,
        'value'     => function ($data) {
            if ($data["status_id"] == OrderStatus::STATUS_IN_WORK) {
                return 'В работе';
            } else if ($data["status_id"] == OrderStatus::STATUS_DONE) {
                return 'Выполнен';
            }
        },
    ],
];
?>

<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['enablePushState' => true, 'id' => 'orderList', 'timeout' => 5000]); ?>    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'options'      => ['style' => 'table-layout:fixed;'],
        'columns'      => $gridColumns,
    ]);
    ?>
    <?php Pjax::end(); ?></div>



