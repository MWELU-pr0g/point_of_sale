<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RecordForm */

$this->title = 'Update Record Form: ' . $model->product_name;
$this->params['breadcrumbs'][] = ['label' => 'Record Forms', 'url' => ['product']];
$this->params['breadcrumbs'][] = ['label' => $model->product_name, 'url' => ['view', 'id'=>'productID']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="record-form-update">

    <h1><?= Html::encode($this->title)?></h1>

    <?= $this->render('product', [
        'model' => $model,
    ]) ?>

</div>