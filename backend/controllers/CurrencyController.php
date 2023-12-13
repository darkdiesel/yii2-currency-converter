<?php

namespace backend\controllers;

use backend\models\Currency;
use backend\models\CurrencySearch;
use backend\models\CurrencyValues;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\httpclient\Client;
use \Datetime;

/**
 * CurrencyController implements the CRUD actions for Currency model.
 */
class CurrencyController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Currency models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CurrencySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Currency model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Currency model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Currency();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Currency model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Currency model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionRefresh(){
        $current_date = new DateTime();

        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl('http://www.cbr.ru/scripts/XML_daily.asp?date_req='.$current_date->format('d/m/Y'))
            ->send();
        if ($response->isOk) {
            $data = $response->getData();

            if (!isset($data['Valute']))
                return $this->redirect(['index']);

            foreach ($data['Valute'] as $currency) {
                // check if currency not exist then create new
                if (($currency_model = Currency::findOne(['currency_id' => $currency['@attributes']['ID']])) == null) {
                    $currency_model = new Currency();
                }

                // or not update on every refresh
                $currency_model->currency_id = $currency['@attributes']['ID'];
                $currency_model->num_code = $currency['NumCode'];
                $currency_model->chart_code = $currency['CharCode'];
                $currency_model->name = $currency['Name'];

                $currency_model->save();


                if (($currency_value_model = CurrencyValues::findOne(['currency_id' => $currency_model->id, 'date' => $current_date->format('Y-m-d')])) == null) {
                    $currency_value_model = new CurrencyValues();
                }

                $currency_value_model->currency_id = $currency_model->id;
                $currency_value_model->nominal = $currency['Nominal'];
                $currency_value_model->rate = str_replace(",", ".", $currency['Value']); //@TODO: move to behaviours
                $currency_value_model->v_unit_rate = str_replace(",", ".", $currency['VunitRate']); //@TODO: move to behaviours
                $currency_value_model->date = $current_date->format('Y-m-d');

                $t = $currency_value_model->save();

                //echo $currency['CharCode'];
            }
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Currency model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Currency the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Currency::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
