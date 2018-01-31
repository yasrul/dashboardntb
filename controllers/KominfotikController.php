<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\base\DynamicModel;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

use app\models\Adapter;


/**
 * Description of KominfotikController
 *
 * @author yasrul
 */
class KominfotikController extends Controller {
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['sisensi'],
                'rules' => [
                    [
                        'actions' => ['sisensi'],
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
    
    public function actionSisensi() {
        //Create dinamic model
        $model = new DynamicModel(['tgl','deptid']);
        $model->addRule(['tgl','deptid'], 'required' )
                ->addRule(['tgl'], 'date')
                ->addRule(['deptid'], 'integer');
        
        $model->attributes(['tgl' => 'Tanggal']);
        
        $model->load(Yii::$app->request->queryParams);
        
        //Web API absensi_online
        $adapter = new Adapter();
        $url='http://simantra.ntbprov.go.id/mantra/json/diskominfotik_ntbprov/presensi_online/';
        
        $method='get_opd';
        $accesskey='o1srx3f0ig';
        
        $table = $adapter->callAPI($endpoint=$url, $operation=$method, $accesskey, $parameter=[], $callmethod='REST');
        $listOPD = ArrayHelper::map($table['response']['data'][$method], 'DeptID', 'DeptName');

        
        $method='absen_harian';
        $accesskey='5otjjv8g18';
        $request=isset($model)?$model : array();

        $table = $adapter->callAPI ($endpoint=$url, $operation=$method, $accesskey, $parameter=$request, $callmethod='REST');

        $dataProvider = new ArrayDataProvider([
            'allModels' => $table['response']['data'][$method],
            'pagination'=> [
                'pageSize'=>20,
            ],
        ]);
        return $this->render('absen-harian', [
            'dataAbsensi' => $dataProvider,
            'model' => $model,
            'listOPD' => $listOPD
        ]);
    }
}
