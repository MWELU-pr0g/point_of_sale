<?php 
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
use yii\data\ArrayDataProvider;
use yii\db\ActiveRecord;

class ClientForm extends ActiveRecord
{
 

    /**
     * {@inheritdoc}
     * 
     */
    public static function tableName(){
        return 'customer';        
    }
    public function rules()
    {
        return [
            ['name', 'required'],


             ['contact', 'required'],
            ['contact', 'integer'],


            ['email', 'required'],
            ['email', 'unique'],
             ['email', 'email'],

           
        ];
    }
    public function attributeLabels()
    {
        return [
            'name' => 'Customer name',
            'email' => 'Customer email address',
            'contact' => 'Phone Number',
        ];
    }
    public function customer()
    {
        $model = Yii::$app->db->createCommand('SELECT * FROM customer')
            ->queryAll();


        $data =  new ArrayDataProvider(
            [
                'allModels' => $model,
            ]
        );

        // print_r($data);exit;

        return $data;
    }

}