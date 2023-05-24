<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = 'Редактирование заказа: ' . $order->name;
$this->params['breadcrumbs'][] = 'Редактирование заказа';
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact(
        'order',
        //'dataProvider',
        //'orderSearch',
    )) ?>

</div>
