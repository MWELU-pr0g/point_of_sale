<?php

namespace app\controllers;

use app\models\ClientForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ProductForm;
use app\models\RegisterForm;
use app\models\SalesForm;
use app\models\User;

class SalesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    public function actionSales()
    {
        $model = new SalesForm();

        if (Yii::$app->request->isPost) {

            $model->load(Yii::$app->request->post());

            $product_id = $model->productID;
            $product_name = ProductForm::find()
            ->where(['productID' => $product_id])
            ->one()
            ->product_name;


            $retail_cost = ProductForm::find()
                ->where(['productID' => $product_id])
                ->one()
                ->retail_cost;

                $customer_id = $model->customerID;
            $customer_name = ClientForm::find()
            ->where(['customerID' => $customer_id])
            ->one()
            ->name;

            $model->amount = $retail_cost;
            $model->productID = $product_name;
            $model->customerID = $customer_name;

            $model->date = date('Ymdhis');

            if ($model->save()) {
                Yii::$app->session->setFlash('success', "Sale record saved successfully.");
            } else {
                Yii::$app->session->setFlash('error', "Something went wrong!.");
                $erros = $model->errors;
                var_dump($erros);
            }
        }

        $model = new SalesForm();

        return $this->render('sales', [
            'data' => $model,
        ]);
    }
    public function actionViewsales()
    {
        $model = new SalesForm();

        $data = $model->sale();

        //    print_r($data);exit;

        return $this->render('viewsales', [
            'dataProvider' => $data,


        ]);
    }
}
