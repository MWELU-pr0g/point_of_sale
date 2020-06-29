<?php

use Codeception\Step\Action;
use yii\bootstrap4\Alert;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RecordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'STOCK IN SHOP';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="product-view">

    <p>
        <?= Html::a('ADD', ['product'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('SALE', ['//sales/sales'], ['class' => 'btn btn-success']) ?>
        </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>
 

    <?=

    
         GridView::widget([


            'dataProvider' => $dataProvider,      
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
               
               'product_name',
               'description',
               'UnitInStock',
               'wholesale_cost',
               'retail_cost',
               'alert_level',
               'date',
               

                   [
      'label'=>'Alert Status',
      'format' => 'raw',
       'value'=>function ($dataProvider) {
           $stock= $dataProvider['UnitInStock'];
           $alert= $dataProvider['alert_level'];

          if ($stock<=$alert) {
              return '<span  style="color:red;font-weight:bold">TIME TO BUY</span>';
          }
          
           else {
              return '<span style="color:blue;font-weight:bold">SALE</span>';
          }
      },
   
     ], 
     [
        'label'=>'Actions',
        'format' => 'raw',
        'value'=>function($dataProvider){
    
          return '<div style="width:250px">
          <p>'.Html::a('view',['viewone','id'=>$dataProvider['productID']], ['class'=>'btn btn-default'],).
          '<span> | '.Html::a('update', ['update','id'=>$dataProvider['productID']], ['class'=>'btn btn-primary']).'</span>
          <span> | '.Html::a('Delete', ['delete','id'=>$dataProvider['productID']], ['class'=>'btn btn-danger']).'</span>
          </p></div>';
          
        
    
          
        },
        ], 
    
      
           
    ],
    
    
        ]);
        ?>
        <div>
    
      <?= Html::a('<i class="fa far fa-hand-point-up"></i> Print',['/product/statementview'], [
    'class'=>'btn btn-primary', 
    'target'=>'_blank', 
    'data-toggle'=>'tooltip', 
    'title'=>'Will open the generated PDF file in a new window'
    
]);
?>
</div>
</div>