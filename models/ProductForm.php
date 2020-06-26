<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ArrayDataProvider;
use yii\db\ActiveRecord;
use yii\debug\models\timeline\DataProvider;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class ProductForm extends ActiveRecord
{
    public $item=true;



    public static function tableName()
    {
        return 'products';
    }


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['description', 'product_name', 'UnitInStock'], 'required'],
            [['stock', 'wholesale_cost', 'retail_cost'], 'required'],
            [['alert_level'], 'required'],
            
        ];
    }
    public function attributeLabels()
    {
        return [
            'product_name' => 'Product Name',
            'description' => 'Product Description',
            'UnitInStock' => 'Unit in Stock',
            'stock' => 'stock',
            'wholesale_cost' => 'Buying Price',
            'retail_cost' => 'Selling Price',
            'alert_level' => 'Alert level',

        ];
    }
    public function product()
    {
        $model = Yii::$app->db->createCommand('SELECT * FROM products')
            ->queryAll();


        $data =  new ArrayDataProvider(
            [
                'allModels' => $model,
            ]
        );  

        // print_r($data);exit;

        return $data;
    }
    /**
 * Finds user by email
 *
 * @param string $email
 * @return static|null
 */
public static function findByUnitInStock($UnitInStock)
{
    return static::findOne(['UnitInStock' => $UnitInStock]);
}
/**
 * Finds user by email
 *
 * @param string $email
 * @return static|null
 */
public static function findByAlert_level($alert_level)
{
    return static::findOne(['alert_level' => $alert_level]);
}
public function getproduct($id)
{
    $model = Yii::$app->db->createCommand('SELECT * FROM products WHERE id=:id')->bindValue('id',$id)->queryOne();
    
    return $model;

    // print_r($model);exit;

    $data =  new ArrayDataProvider(
        [
            'models' => $model,
        ]
    );
    return $data;
}

  
      




}