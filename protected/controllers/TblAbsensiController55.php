<?php

class TblAbsensiController extends Controller
{
	
	
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
		
	public $layout='//layouts/column1';		
		/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
						
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
						
		);
	}
	
		/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','create','viewabsuser','updateuser','viewpop'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','export','import','editable','toggle','createmaster','lookupnik','update'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionViewabsuser()
 	{
 		//$sql='SELECT * FROM tbl_absensi';

	$model=new TblAbsensi('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TblAbsensi']))
			$model->attributes=$_GET['TblAbsensi'];
		$this->render('viewabsuser',array('model'=>$model));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionViewpop($id)
	{
		
		if(isset($_GET['asModal'])){
			$this->renderPartial('viewpop',array(
				'model'=>$this->loadModel($id),
			));
		}
		else{
						
			$this->render('viewpop',array(
				'model'=>$this->loadModel($id),
			));
			
		}
	}
		
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		
		if(isset($_GET['asModal'])){
			$this->renderPartial('view',array(
				'model'=>$this->loadModel($id),
			));
		}
		else{
						
			$this->render('view',array(
				'model'=>$this->loadModel($id),
			));
			
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreatemaster()
	{
				
		$model=new TblAbsensi;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TblAbsensi']))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try{
				$messageType='warning';
				$message = "There are some errors ";
				$model->attributes=$_POST['TblAbsensi'];
				//$checkAwal=strtotime(date('Y-m-d H:i:s'));
				//$checkDate=strtotime(date('Y-m-d 18:00:00'));
				//$checkPertama=strtotime(date('Y-m-d 17:40:00'));
				//$model->status='Lembur';
				
				//if ($checkDate<$checkAwal) {
				//	$model ->addError('Absensi','Anda tidak dapat melakukan absensi lembur karena telah melewati batas waktu');
				//}elseif ($checkAwal<$checkPertama) {
				//	$model->addError('Absensi','Anda terlalu cepat melakukan absensi lembur');
				//}else{

				if($model->save()){

					$messageType = 'info';
					$message = "Anda berhasil menambah data absensi lembur";


					$transaction->commit();
					Yii::app()->user->setFlash($messageType, $message);
					$this->redirect(array('admin','id'=>$model->id_absen));
				}	
				//}			
			}
			catch (Exception $e){
				$transaction->rollBack();
				Yii::app()->user->setFlash('error', "{$e->getMessage()}");
				//$this->refresh();
			}
			
		}

		$this->render('createmaster',array(
			'model'=>$model,
					));
		
				
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
				
		$model=new TblAbsensi;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TblAbsensi']))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try{
				$messageType='warning';
				$message = "There are some errors ";
				$model->attributes=$_POST['TblAbsensi'];
				$checkAwal=strtotime(date('Y-m-d H:i:s'));
				$checkDate=strtotime(date('Y-m-d 18:20:00'));
				$checkPertama=strtotime(date('Y-m-d 17:40:00'));
				$model->status='Lembur';
				
				if ($checkDate<$checkAwal) {
					$model ->addError('Absensi','Anda tidak dapat melakukan absensi lembur karena telah melewati batas waktu');
				}elseif ($checkAwal<$checkPertama) {
					$model->addError('Absensi','Anda terlalu cepat melakukan absensi lembur');
				}else{

				if($model->save()){

					$messageType = 'info';
					$message = "Anda berhasil melakukan Absen Lembur dengan keterangan Lembur";


					$transaction->commit();
					Yii::app()->user->setFlash($messageType, $message);
					$this->redirect(array('updateuser','id'=>$model->id_absen));
				}	
				}			
			}
			catch (Exception $e){
				$transaction->rollBack();
				Yii::app()->user->setFlash('error', "{$e->getMessage()}");
				//$this->refresh();
			}
			
		}

		$this->render('create',array(
			'model'=>$model,
					));
		
				
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		
		$model=$this->loadModel($id);
		//$model = new DateTime;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TblAbsensi']))
		{
			$messageType='warning';
			$message = "There are some errors ";
			$transaction = Yii::app()->db->beginTransaction();
			try{
				$model->attributes=$_POST['TblAbsensi'];
				$model->pulang_time=date('Y-m-d H:i:s');
				//$diff = date('Y-m-d H:i:s',strtotime($model->pulang_time)) - date('Y-m-d H:i:s',strtotime($model->id_absen));
				//$model->total_jam=$interval;
				//echo $interval->format('%d days %h hours %i minutes');

				//$query = "SELECT absen_time, pulang_time, TIMESTAMPDIFF(HOUR, absen_time, pulang_time) AS total_jam FROM tbl_absensi";
				//$command =Yii::app()->db->createCommand($query);
				//$command->save();

				//$model->total_jam=$command;
				//$checkDate2=TblAbsensi::model()->findAllBySql("SELECT absen_time FROM tbl_absensi WHERE id_absen='$id'");
				//$checkDate2 = TblAbsensi::model()->findAllBySql('SELECT absen_time FROM tbl_absensi WHERE id_absen=:absen', array(':absen'=>$model->id_absen));

				//$total = abs($checkDate2 - $checkDate) / (60*60);

				//$model->total_jam=$checkDate - $checkDate2;


				//$diff = (strtotime($model->absen_time) - strtotime($model->pulang_time) / (60 * 60 * 24));
				$messageType = 'info';
				$message = "Anda telah merubah data lembur";

				if($model->save()){
					$transaction->commit();
					Yii::app()->user->setFlash($messageType, $message);
					$this->redirect(array('admin','id'=>$model->id_absen));
				}
			}
			catch (Exception $e){
				$transaction->rollBack();
				Yii::app()->user->setFlash('error', "{$e->getMessage()}");
				// $this->refresh(); 
			}

			$model->attributes=$_POST['TblAbsensi'];
			if($model->save())
				$this->redirect(array('admin','id'=>$model->id_absen));
		}

		$this->render('update',array(
			'model'=>$model,
					));
		
			}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdateuser($id)
	{
		
		$model=$this->loadModel($id);
		//$model = new DateTime;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TblAbsensi']))
		{
			$messageType='warning';
			$message = "There are some errors ";
			$transaction = Yii::app()->db->beginTransaction();
			try{
				$model->attributes=$_POST['TblAbsensi'];
				//$model->pulang_time=date('Y-m-d H:i:s',$checkDatePulang);
				//$checkDatePulang = date('Y-m-d H:i:s');
				$checkDateAwal =isset($_GET['absen_time']);

				$checkDate2 = strtotime($checkDateAwal=date('Y-m-d H:i'));
				$checkDate1 = strtotime($model->pulang_time=date('Y-m-d H:i:s'));
				
				$differenceTime = round(abs($checkDate2 - $checkDate1)/(3600.60)).' Jam';

				$model->total_jam=$differenceTime;

				$messageType = 'info';
				$message = "Anda telah absen jam kepulangan";

				if($model->save()){
					$transaction->commit();
					Yii::app()->user->setFlash($messageType, $message);
					$this->redirect(array('viewabsen','id'=>$model->id_absen));
				}
			}
			catch (Exception $e){
				$transaction->rollBack();
				Yii::app()->user->setFlash('error', "{$e->getMessage()}");
				// $this->refresh(); 
			}

			$model->attributes=$_POST['TblAbsensi'];
			if($model->save())
				$this->redirect(array('viewabsen','id'=>$model->id_absen));
		}

		$this->render('updateuser',array(
			'model'=>$model,
					));
		
			}


	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		/*
		$dataProvider=new CActiveDataProvider('TblAbsensi');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
		*/
		
		$model=new TblAbsensi('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TblAbsensi']))
			$model->attributes=$_GET['TblAbsensi'];

		$this->render('index',array(
			'model'=>$model,
					));
		
			}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		
		$model=new TblAbsensi('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TblAbsensi']))
			$model->attributes=$_GET['TblAbsensi'];
		

		$this->render('admin',array(
			'model'=>$model,
					));
		
			}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TblAbsensi the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TblAbsensi::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TblAbsensi $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tbl-absensi-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionExport()
    {
        $model=new TblAbsensi;
		$model->unsetAttributes();  // clear any default values
		if(isset($_POST['TblAbsensi']))
			$model->attributes=$_POST['TblAbsensi'];

		$exportType = $_POST['fileType'];
        $this->widget('ext.heart.export.EHeartExport', array(
            'title'=>'Data Absensi Lembur',
            'dataProvider' => $model->search(),
            'filter'=>$model,
            'grid_mode'=>'export',
            'exportType'=>$exportType,
            'columns' => array(
	                
					//'id_absen',
            	array(
            		'header'=>'NIP',
            		'name'=>'nip',
            	),

            	array(
            		'header'=>'Absen Lembur',
            		'name'=>'absen_time'
            	),

            	array(
            		'header'=>'Status',
            		'name'=>'status',
            	),

            	array(
            		'header'=>'Keterangan',
            		'name'=>'keterangan',
            	),

            	array(
            		'header'=>'Absen Pulang',
            		'name'=>'pulang_time',
            	),

            	array(
            		'header'=>'Total Lembur',
            		'name'=>'total_jam',
            	),
					//'absen_time',
					//'status',
	            ),
        ));
    }

    /**
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionImport()
	{
		
		$model=new TblAbsensi;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TblAbsensi']))
		{
			if (!empty($_FILES)) {
				$tempFile = $_FILES['TblAbsensi']['tmp_name']['fileImport'];
				$fileTypes = array('xls','xlsx'); // File extensions
				$fileParts = pathinfo($_FILES['TblAbsensi']['name']['fileImport']);
				if (in_array(@$fileParts['extension'],$fileTypes)) {

					Yii::import('ext.heart.excel.EHeartExcel',true);
	        		EHeartExcel::init();
	        		$inputFileType = PHPExcel_IOFactory::identify($tempFile);
					$objReader = PHPExcel_IOFactory::createReader($inputFileType);
					$objPHPExcel = $objReader->load($tempFile);
					$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
					$baseRow = 2;
					$inserted=0;
					$read_status = false;
					while(!empty($sheetData[$baseRow]['A'])){
						$read_status = true;						
						$id_absen=  $sheetData[$baseRow]['A'];
						$absen_time=  $sheetData[$baseRow]['B'];
						$status=  $sheetData[$baseRow]['C'];

						$model2=new TblAbsensi;
						$model2->id_absen=  $id_absen;
						$model2->absen_time=  $absen_time;
						$model2->status=  $status;

						try{
							if($model2->save()){
								$inserted++;
							}
						}
						catch (Exception $e){
							Yii::app()->user->setFlash('error', "{$e->getMessage()}");
							//$this->refresh();
						} 
						$baseRow++;
					}	
					Yii::app()->user->setFlash('success', ($inserted).' row inserted');	
				}	
				else
				{
					Yii::app()->user->setFlash('warning', 'Wrong file type (xlsx, xls, and ods only)');
				}
			}


			$this->render('admin',array(
				'model'=>$model,
			));
		}
		else{
			$this->render('admin',array(
				'model'=>$model,
			));
		}
	}

	public function actionEditable(){
		Yii::import('bootstrap.widgets.TbEditableSaver'); 
	    $es = new TbEditableSaver('TblAbsensi'); 
			    $es->update();
	}

	public function actions()
	{
    	return array(
        		'toggle' => array(
                	'class'=>'bootstrap.actions.TbToggleAction',
                	'modelName' => 'TblRegistrasi',
        		),
        		'captcha'=>array(
        			'class'=>'CCaptchaAction',
        			'backColor'=>0xFFFFFF,
        		),
        		'page'=>array(
        			'class'=>'CViewAction',
        		),
    	);
	}


	public function actionLookupnik()
	{
		$kin = $_POST['TblAbsensi']['nip'];
		$nm = $_POST['Personal']['nama_lengkap'];
		//$st = $_POST['TblPersonal']['id_kotkab'];

		// $list = TblProdi::model()->findAll('fak_id = :provinsi_id', array(':provinsi_id'=>$provinsi_id));
		$list = Personal::model()->findAllBySql('SELECT * FROM personal WHERE nip=:pin AND nama_lengkap:nm', array(':pin'=>$kin,'nm'=>$nm));
		$list = CHtml::listData($list,'nip','nama_lengkap');
		echo CHtml::tag('option',array('value'=>''),'Pilih NIP', true);
		foreach($list as $value=>$nama){
			echo CHtml::tag('option',array('value'=>$value),CHtml::encode($nama), true);
		}
	}

	
}
