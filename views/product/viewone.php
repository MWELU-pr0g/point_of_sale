<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RecordForm */

$this->title = 'Product';
$this->params['breadcrumbs'][] = ['label' =>'product', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="product-form-viewone">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
       

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'product_name',
                'description',
                'UnitInStock',
                'wholesale_cost',
                'retail_cost',
                'alert_level',
                'date',
            ],
        ]) ?>


</div>