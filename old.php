//SiteController
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

//index.php view
<div class="col-lg-4">
                <h2>Informasi Sistem Satu</h2>

                <p>Percobaan Satu</p>
                <?= GridView::widget([
                'dataProvider'=> $dataPresensi,
                'formatter'=>['class'=>'yii\i18n\Formatter' ,'nullDisplay'=>'Nihil'],
                //'options'=>['style'=>'width : 50%'],
                'columns'=> [
                    ['class'=>'yii\grid\SerialColumn','contentOptions'=>['style'=>'width :7%']],
                    ['attribute'=>'id', 'contentOptions'=>['style'=>'width: 10%']],
                    ['attribute'=>'userid', 'contentOptions'=>['style'=>'width: 10%']],
                    ['attribute'=>'checktime', 'contentOptions'=>['style'=>'width: 10%']],
                ]
                ])
                ?> 
                
            </div>
            <div class="col-lg-4">
                <h2>Informasi Sistem Dua</h2>

                <p>Percobaan Dua</p>
                <div class="form">
                    <?php $form2 = ActiveForm::begin([
                            'action' => ['index'],
                            'method' => 'get',
                    ]); ?>
                    <?= $form2->field($model2, 'tgl'); ?>
                    <?= $form2->field($model2, 'deptid'); ?>
                    
                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
                
                <?= GridView::widget([
                'dataProvider'=> $dataAbsensi,
                'formatter'=>['class'=>'yii\i18n\Formatter' ,'nullDisplay'=>'Nihil'],
                //'options'=>['style'=>'width : 50%'],
                'columns'=> [
                    ['class'=>'yii\grid\SerialColumn','contentOptions'=>['style'=>'width :7%']],
                    ['attribute'=>'userid', 'contentOptions'=>['style'=>'width: 10%']],
                    ['attribute'=>'name', 'contentOptions'=>['style'=>'width: 10%']],
                    ['attribute'=>'Datang', 'contentOptions'=>['style'=>'width: 10%']],
                    ['attribute'=>'Pulang', 'contentOptions'=>['style'=>'width: 10%']]
                ]
                ])
                ?> 
            </div>
            <div class="col-lg-4">
                <h2>Informasi Sistem Tiga</h2>

                <p>Percobaan Tiga</p>
            </div>
