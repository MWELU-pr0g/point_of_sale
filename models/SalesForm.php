<?php 
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
use yii\data\ArrayDataProvider;
use yii\db\ActiveRecord;

class SalesForm extends ActiveRecord
{
 

    /**
     * {@inheritdoc}
     * 
     */
    public static function tableName(){
        return 'sale';        
    }
    public function rules()
    {
        return [
            ['quantity', 'required'],
            ['quantity', 'integer'],

            [['productID'],'required' ],
            [['customerID'],'required' ],



            ['amount', 'required'],
            ['amount', 'integer'],

            ['comments', 'required'],



           
        ];
    }
    public function attributeLabels()
    {
        return [
            'comments' => 'Comments',
            'quantity' => 'Number of Products',
            'amount' => 'Amount Paid',
        ];
    }
    
    public function getProducts(){
        return $this->hasOne(ProductForm::className(),['productID'=>'productID']);
    }
    public function getCustomer(){
        return $this->hasOne(ProductForm::className(),['customerID'=>'customer  ID']);
    }

    public function sale()
    {
        $model = Yii::$app->db->createCommand('SELECT * FROM sale')
            ->queryAll();

        $data =  new ArrayDataProvider(
            [
                'allModels' => $model,
            ]
        );

        // print_r($data);exit;

        return $data;
    }
    public static function getTotal($dataProvider)
    {
        $sum = 0;
        // $total2= 0;

        foreach ($dataProvider as $item) {
            $stock= $item['quantity'];
            $alert= $item['amount'];   
            $total=$stock*$alert;
          $sum += $total;
        //   $total2 += $item['quantity'];
            // $sum=$total+$total2;
      }
      return "Total Amount=".$sum;  
    }
public static function getSum($dataProvider)
{
    $total = 0;
    foreach ($dataProvider as $item) {
      $total += $item['amount'];
  }
  return $total;  
}

}