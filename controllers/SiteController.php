<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use yii\base\DynamicModel;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Adapter;

class SiteController extends Controller
{
    /**
     * @inheritdoc
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
     * @inheritdoc
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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        //Web API presensi_online
        $adapter1 = new Adapter();
        $url='http://simantra.ntbprov.go.id/mantra/json/diskominfotik_ntbprov/presensi_online/';
	$method='presensi_harian';
	$accesskey='ecvg645gep';
	$request=isset($_POST["par"])?$_POST["par"]:array();

	$table =$adapter1->callAPI (
		$endpoint=$url,
		$operation=$method,
		$accesskey,
		$parameter=$request,
		$callmethod='REST' // call option: GET, POST, REST, RESTFULL, RESTFULLPAR
	);
	if(isset($table['response']['data'][$method])) {
            
        }
        $dataProvider1 = new ArrayDataProvider([
            'allModels' => $table['response']['data'][$method],
            'pagination'=> [
                'pageSize'=>20,
            ],
        ]);
        
        //Create dinamic model
        $model2 = new DynamicModel(['tgl','deptid']);
        $model2->addRule(['tgl','deptid'], 'required' )
                ->addRule(['tgl'], 'date')
                ->addRule(['deptid'], 'integer');
        
        $model2->load(Yii::$app->request->queryParams);
        
        //Web API absensi_online
        $adapter2 = new Adapter();
        $url='http://simantra.ntbprov.go.id/mantra/json/diskominfotik_ntbprov/presensi_online/';
        $method='absen_harian';
        $accesskey='5otjjv8g18';
        //$request=isset($_POST["par"])?$_POST["par"]:array();
        $request=isset($model2)?$model2:array();

        $table =$adapter1->callAPI (
            $endpoint=$url,
            $operation=$method,
            $accesskey,
            $parameter=$request,
            $callmethod='REST' // call option: GET, POST, REST, RESTFULL, RESTFULLPAR
        );
        
        $dataProvider2 = new ArrayDataProvider([
            'allModels' => $table['response']['data'][$method],
            'pagination'=> [
                'pageSize'=>20,
            ],
        ]);
        return $this->render('index', [
            'dataPresensi' => $dataProvider1,
            'dataAbsensi' => $dataProvider2,
            'model2' => $model2,
        ]);
               
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionInfo1() {
        
        $url='http://simantra.ntbprov.go.id/mantra/json/diskominfotik_ntbprov/presensi_online/';
	$method='presensi_harian';
	$accesskey='ecvg645gep';
	$request=isset($_POST["par"])?$_POST["par"]:array();

	$table = Adapter::callAPI(
		$endpoint=$url,
		$operation=$method,
		$accesskey,
		$parameter=$request,
		$callmethod='POST' // call option: GET, POST, REST, RESTFULL, RESTFULLPAR
	);
	if(isset($table['response']['data'][$method])) {
            
        }
    }
}
