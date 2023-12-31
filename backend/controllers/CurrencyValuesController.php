<?php

namespace backend\controllers;

use backend\models\CurrencyValues;
use backend\models\Currency;
use backend\models\CurrencyValuesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \Datetime;

/**
 * CurrencyValuesController implements the CRUD actions for CurrencyValues model.
 */
class CurrencyValuesController extends Controller
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
     * Lists all CurrencyValues models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CurrencyValuesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CurrencyValues model.
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
     * Creates a new CurrencyValues model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new CurrencyValues();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                //@TODO: move to behaviours
                $currency_value_date = new DateTime();
                $currency_value_date->createFromFormat('d/m/Y', $model->date);
                $model->date = $currency_value_date->format('Y-m-d');

                if ($model->save())
                    return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        // get currency list
        $currency_list = $this->getCurrencyList();

        return $this->render('create', [
            'model' => $model,
            'currency_list' => $currency_list
        ]);
    }

    /**
     * Updates an existing CurrencyValues model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // get currency list
        $currency_list = $this->getCurrencyList();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'currency_list' => $currency_list
        ]);
    }

    /**
     * Deletes an existing CurrencyValues model.
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

    /**
     * Finds the CurrencyValues model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return CurrencyValues the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CurrencyValues::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getCurrencyList(){
        $currency_list = [];

        // get currency list
        $currency = new Currency();
        foreach ($currency->find()->all() as $currency) {
            $currency_list[$currency->id] = sprintf('%s (%s)', $currency->chart_code, $currency->name);
        }

        return $currency_list;
    }
}
