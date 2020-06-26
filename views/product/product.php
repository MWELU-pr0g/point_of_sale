
<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RecordForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="Product-form-form">

 <?php $form = \yii\bootstrap4\ActiveForm::begin(['id' => 'product-form']) ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->textarea() ?>

    <?= $form->field($model, 'UnitInStock')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stock') ?>

    <?= $form->field($model, 'wholesale_cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alert_level')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a('View',['product/view'] ,['class' => 'btn btn-primary']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>