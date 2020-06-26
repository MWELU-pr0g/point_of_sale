<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use app\models\ClientForm;
use app\models\ProductForm;
use app\models\SalesForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;

$this->title = 'Sales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-sales">


    <div class="card">
        <?php if (Yii::$app->session->hasFlash('success')) : ?>
            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <h4><i class="icon fa fa-check"></i>Saved!</h4>
                <?= Yii::$app->session->getFlash('success') ?>
            </div>
        <?php endif; ?>

        <?php if (Yii::$app->session->hasFlash('error')) : ?>
            <div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <h4><i class="icon fa fa-check"></i>Saved!</h4>
                <?= Yii::$app->session->getFlash('error') ?>
            </div>
        <?php endif; ?>
        <div class="card-body login-card-body">



            <p>Please fill out the following fields to sale products:</p>

            <div class="row">
                <div class="col-lg-5">
                    <?php $form = ActiveForm::begin(['id' => 'form-sales']); ?>
                    <?= $form->field($data, 'customerID')->dropDownList(ArrayHelper::map(ClientForm::find()->all(), 'customerID', 'name'), ['prompt' => 'select Customer']) ?>
                    <?= $form->field($data, 'productID')->dropDownList(ArrayHelper::map(ProductForm::find()->all(), 'productID', 'product_name'), ['prompt' => 'select product']) ?>

                    <?= $form->field($data, 'comments')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($data, 'quantity') ?>



                    <div class="form-group">
                        <?= Html::submitButton('ADD', ['class' => 'btn btn-primary', 'name' => 'sales-button']) ?>
                        <?= Html::a('VIEW SALE', ['sales/viewsales'], ['class' => 'btn btn-primary']) ?>


                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>

    </div>
</div>