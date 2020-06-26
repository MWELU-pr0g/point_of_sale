<?php

use app\models\SalesForm;
use yii\bootstrap4\Alert;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RecordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'View Sales';
$this->params['breadcrumbs'][] = $this->title;

//print_r($total);
?>
<div class="sales-viewsales">


    <p>
        <?= Html::a('save', ['//product'], ['class' => 'btn btn-danger']) ?>
        <?= Html::a('ADD', ['sales/sales'], ['class' => 'btn btn-primary']) ?>


    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>


    <?php Pjax::begin(['id' => 'countries']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'showFooter' => true,
        'columns' => [

            ['class' => 'yii\grid\SerialColumn'],


            'customerID',
            'productID',

            'comments',
            'quantity',
            'amount',
            


            
            'date',
                [
                'label' => 'TOTAL COST',
                'format' => 'raw',
                 'value'=>function ($dataProvider) {

                     $stock= $dataProvider['quantity'];
                     $alert= $dataProvider['amount'];   
                     $total=$stock*$alert;

                   return $total;

                return Html::a($total,Url::to(['sales/viewsales']),
                ['data-params'=>['total'=>$total,'data-method'=>'POST']]);

                },
                'footer' => SalesForm::getTotal($dataProvider->models, 'amount'),
                 'footerOptions' => ['style' => 'background-color:#FF4500'],
// 



                // [
                //     'attribute' =>'amount',
                //     'footer' => SalesForm::getSum($dataProvider->models, 'amount'),
                //    ],
                ],

        

        //     ['class' => ActionColumn::className()],
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>