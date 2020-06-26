<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'New Customer';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-customer">
<div class="card">
    <div class="card-body login-card-body">


    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::a('ALL CUSTOMERS', ['//product/customerview'], ['class' => 'btn btn-success']) ?>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-customer']); ?>

                <?= $form->field($model,'name') ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'contact') ?>



                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'save-button']) ?>

                </div>

                <?php  ActiveForm::end();?>

        <?= Html::a('SALE', ['//sales/sales'], ['class' => 'btn btn-success']) ?>
            
        </div>
    </div>
    </div>
    </div>

</div>