<?php

namespace app\controllers;

use app\models\ClientForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\SalesForm;
use app\models\ProductForm;
use app\models\ProductSearch;
use app\models\dataProvider;

use kartik\mpdf\Pdf;
use yii\web\NotFoundHttpException;

class ProductController extends Controller
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
                    [
                        'actions' => ['register', 'login', 'customer'],
                        'allow' => true,
                        'roles' => ['?'],
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



    /**
     * Creates a new RecordForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $userDetails = new ProductForm();



        if ($userDetails->load(Yii::$app->request->post()) && $userDetails->save()) {
            return $this->render('record', ['model' => $userDetails]);
        }

        return $this->render('record', [
            'model' => $userDetails,
        ]);
    }



    /**
     * Updates an existing RecordForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => 'productID']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing RecordForm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['view', 'id' => 'productID']);
    }

    /**
     * Finds the RecordForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RecordForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductForm::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionViewone($id)
    {
        $model = new ProductForm();
        $data = $model->getproduct($id);

        // print_r($data);exit;
        return $this->render('viewone', [
            'model' => $data, 'id' => 'productID'
        ]);
    }


    public function actionProduct()
    {
        $model = new ProductForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->refresh();
        }
        return $this->render('product', [
            'model' => $model,
        ]);
    }

    public function actionView()
    {
        $model = new ProductForm();

        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $data = $model->product();

        return $this->render('view', [
            'dataProvider' => $data,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,


        ]);
    }
    public function actionCustomerview()
    {
        $model = new ClientForm();

        // $searchModel = new ProductSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $data = $model->customer();

        return $this->render('customerview', [
            'dataProvider' => $data,
            // 'searchModel' => $searchModel,
            // 'dataProvider' => $dataProvider,


        ]);
    }
    public function actionCustomer()
    {
        $model = new ClientForm();
        // $data=new SalesForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()); {


            return $this->render('customer', [
                'model' => $model,
                // 'data' => $data
            ]);
        }
    }
    public function actionStatementview()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
            'destination' => Pdf::DEST_BROWSER,
            'content' => $this->renderPartial('view', [
                'dataProvider' => $dataProvider, 'searchModel' => $searchModel
            ]),
            'options' => [
                // any mpdf options you wish to set
            ],
            'methods' => [
                'SetTitle' => 'Privacy Policy - Krajee.com',
                'SetSubject' => 'Generating PDF files via yii2-mpdf extension has never been easy',
                'SetHeader' => ['Transaction Statement||Generated On: ' . date("r")],
                'SetFooter' => ['|Page {PAGENO}|'],
                'SetAuthor' => 'Kartik Visweswaran',
                'SetCreator' => 'Kartik Visweswaran',
                'SetKeywords' => 'Krajee, Yii2, Export, PDF, MPDF, Output, Privacy, Policy, yii2-mpdf',
            ]
        ]);
        return $pdf->render();
    }

    public function actionPdf()
    {

            // phpinfo();
            $content = $this->renderPartial('view');
            $currentyr = date('Y');
            // setup kartik\mpdf\Pdf component
            $pdf = new Pdf([
                // set to use core fonts only
                'mode' => Pdf::MODE_CORE,
                // A4 paper format
                'format' => Pdf::FORMAT_A4,
                // portrait orientation
                'orientation' => Pdf::ORIENT_PORTRAIT,
                // stream to browser inline
                'destination' => Pdf::DEST_BROWSER,
                // your html content input
                'content' => $content,
                'mode' => Pdf::MODE_UTF8,
                // any css to be embedded if required
                'cssInline' => '.kv-heading-1{font-size:18px}',
                // set mPDF properties on the fly
                'options' => ['title' => 'Helb Benovolent report'],
                // call mPDF methods on the fly
                'methods' => [
                    'SetHeader' => ['Helb Benevolent Report ' . $currentyr],
                    'SetFooter' => ['{PAGENO}'],
                ]
            ]);

            // return the pdf output as per the destination setting
            return $pdf->render();

    }
}
