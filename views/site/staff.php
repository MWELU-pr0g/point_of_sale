<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RecordForm */

$this->title = $model->username .'Succesffully Login';
$this->params['breadcrumbs'][] = ['label' => 'Staff Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="staff-form">

    <h1><?= Html::encode($this->title) ?></h1>
  

    <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'username',
                'email',
                // 'date',
                
            ],
        ]) ?>

        <?= Html::a('Make Sales',['//product/customer'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Report', ['report'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Add To Stock', ['//product/product'], ['class' => 'btn btn-success']) ?>


</div>