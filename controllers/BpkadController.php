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
 * Description of BpkadController
 *
 * @author yasrul
 */
class BpkadController extends Controller {
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [''],
                'rules' => [
                    [
                        'actions' => [''],
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
    
    public function actionSetProgram() {
        $model = new DynamicModel(['Tahun','Kd_Urusan','Kd_Bidang','Kd_Unit','Kd_Sub','Kd_Prog','ID_Prog','Ket_Program',
            'Tolak_Ukur','Target_Angka','Target_Uraian','Kd_Urusan1','Kd_Bidang1']);
        $model->addRule(['Tahun','Kd_Urusan','Kd_Bidang','Kd_Unit','Kd_Sub','Kd_Prog','ID_Prog','Ket_Program'], 'required');
        $model->addRule(['Tahun','Kd_Urusan','Kd_Bidang','Kd_Unit','Kd_Sub','Kd_Prog','ID_Prog'], 'integer');
        $model->addRule(['Ket_Program','Tolak_Ukur','Target_Uraian'], 'string');
        $model->addRule(['Target_Angka'], 'double');
        
        if ($model->load(Yii::$app->request->post())) {
            $adapter = new Adapter();
            $url='http://simantra.ntbprov.go.id/mantra/api/bpkad_ntbprov/simda_keuangan/';
            
            $method='set_program';
            $accesskey='hfodjzr3ta';
            $request=isset($model)?$model : array();

            $table = $adapter->callAPI ($endpoint=$url, $operation=$method, $accesskey, $parameter=$request, $callmethod='REST');
        } else {
            return $this->render('create-program', [
                'model' => $model]);
        }
    }
}
