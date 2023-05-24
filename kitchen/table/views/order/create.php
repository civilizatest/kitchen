<?php

use app\models\OrderStatus;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\OrderStatus */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Создание нового заказа';
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="order-create">

    <section class="content">
        <h3>Создание нового заказа</h3>

            <div class="box-body">

                <?php $form = ActiveForm::begin([
                    'enableClientValidation' => false,
                ]); ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Название заказа') ?>

                <?= $form->field($model, 'status_id')->dropDownList(ArrayHelper::map(OrderStatus::getListOrderStatuses(), 'id', 'name')); ?>

                <br>
                <div class="form-group">
                    <?= Html::submitButton('Создать', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
    </section>
</div>