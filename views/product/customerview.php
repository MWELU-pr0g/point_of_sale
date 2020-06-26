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

$this->title = 'CUSTOMERS';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="product-customerview">

    <p>
        <?= Html::a('NEW CUSTOMER', ['customer'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('SALE', ['//sales/sales'], ['class' => 'btn btn-success']) ?>
        </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>
 

    <?=

    
         GridView::widget([


            'dataProvider' => $dataProvider,      
            // 'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
               
               'name',
               'email',
               'contact',
               'date',
            ],

               
               ]);
               ?>
               </div>
               </div>