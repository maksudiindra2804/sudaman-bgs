<?php

class DataKompensasiController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','export','import','editable','toggle','lookuppegawai'),
				'users'=>array('adminbgs'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
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
	public function actionCreate()
	{
				
		$model=new DataKompensasi;
		$model2 = new TblAbsensi;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DataKompensasi']))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try{
				$messageType='warning';
				$message = "There are some errors ";
				$model->attributes=$_POST['DataKompensasi'];
				if($model->save()){
					$messageType = 'info';
					$message = "<strong>Anda berhasil menambah data Kompensasi</strong>";

					$transaction->commit();
					Yii::app()->user->setFlash($messageType, $message);
					$this->redirect(array('admin','id'=>$model->id_kompensasi));
				}				
			}
			catch (Exception $e){
				$transaction->rollBack();
				Yii::app()->user->setFlash('error', "{$e->getMessage()}");
				//$this->refresh();
			}
			
		}

		$this->render('create',array(
			'model'=>$model,'model2'=>$model2
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DataKompensasi']))
		{
			$messageType='warning';
			$message = "There are some errors ";
			$transaction = Yii::app()->db->beginTransaction();
			try{
				$model->attributes=$_POST['DataKompensasi'];

				$messageType = 'info';
				$message = "<strong>Anda berhasil merubah data Kompensasi</strong>";

				if($model->save()){
					$transaction->commit();
					Yii::app()->user->setFlash($messageType, $message);
					$this->redirect(array('admin','id'=>$model->id_kompensasi));
				}
			}
			catch (Exception $e){
				$transaction->rollBack();
				Yii::app()->user->setFlash('error', "{$e->getMessage()}");
				// $this->refresh(); 
			}

			$model->attributes=$_POST['DataKompensasi'];
			if($model->save())
				$this->redirect(array('admin','id'=>$model->id_kompensasi));
		}

		$this->render('update',array(
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
		$dataProvider=new CActiveDataProvider('DataKompensasi');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
		*/
		
		$model=new DataKompensasi('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DataKompensasi']))
			$model->attributes=$_GET['DataKompensasi'];

		$this->render('index',array(
			'model'=>$model,
					));
		
			}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		
		$model=new DataKompensasi('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DataKompensasi']))
			$model->attributes=$_GET['DataKompensasi'];

		$this->render('admin',array(
			'model'=>$model,
					));
		
			}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return DataKompensasi the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=DataKompensasi::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param DataKompensasi $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='data-kompensasi-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionExport()
    {
        $model=new DataKompensasi;
		$model->unsetAttributes();  // clear any default values
		if(isset($_POST['DataKompensasi']))
			$model->attributes=$_POST['DataKompensasi'];

		$exportType = $_POST['fileType'];
        $this->widget('ext.heart.export.EHeartExport', array(
            'title'=>'Data Kompensasi Pegawai',
            'dataProvider' => $model->search(),
            'filter'=>$model,
            'grid_mode'=>'export',
            'exportType'=>$exportType,
            'columns' => array(
	                
					array(
						'header'=>'NIP Pegawai',
						'name'=>'nip',
						'value'=>'$data->nip0->nip',
					),

					array(
						'header'=>'Nama Lengkap',
						'name'=>'nip',
						'value'=>'$data->nip0->nama_lengkap',
					),

					array(
						'header'=>'Jabatan',
						'name'=>'id_jabatan',
						'value'=>'$data->idJabatan->nama_jabatan',
					),

					array(
						'header'=>'Data Pelatihan Talenta',
						'name'=>'id_talent',
						'value'=>'$data->idTalent->keterangan',
					),

					array(
						'header'=>'Status Pelatihan Talenta',
						'name'=>'id_talent',
						'value'=>'$data->idTalent->status',
					),

					array(
						'header'=>'Keterangan Pelatihan Karier',
						'name'=>'id_karier',
						'value'=>'$data->idKarier->keterangan',
					),

					array(
						'header'=>'Deskripsi Pelatihan Karier',
						'name'=>'id_karier',
						'value'=>'$data->idKarier->deskripsi',
					),

					array(
						'header'=>'Status Pelatihan Karier',
						'name'=>'id_karier',
						'value'=>'$data->idKarier->status',
					),

					array(
						'header'=>'Data Absensi Lembur',
						'name'=>'id_absen',
						'value'=>'$data->idAbsen->status',
					),

					array(
						'header'=>'Total Jam Lembur',
						'name'=>'id_absen',
						'value'=>'$data->idAbsen->total_jam',
					),

					array(
						'header'=>'Jenis Kompensasi',
						'name'=>'jenis_reward',
						'value'=>'$data->jenis_reward',
					),

					array(
						'header'=>'Keterangan Kompensasi',
						'name'=>'keterangan_reward',
						'value'=>'$data->keterangan_reward',
					),

					array(
						'header'=>'Jumlah Kompensasi',
						'name'=>'jumlah',
						'value'=>'$data->jumlah',
					),
	            ),
        ));
    }

    /**
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionImport()
	{
		
		$model=new DataKompensasi;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DataKompensasi']))
		{
			if (!empty($_FILES)) {
				$tempFile = $_FILES['DataKompensasi']['tmp_name']['fileImport'];
				$fileTypes = array('xls','xlsx'); // File extensions
				$fileParts = pathinfo($_FILES['DataKompensasi']['name']['fileImport']);
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
						//$id_kompensasi=  $sheetData[$baseRow]['A'];
						$nip=  $sheetData[$baseRow]['B'];
						$nama_lengkap=  $sheetData[$baseRow]['C'];
						$id_jabatan=  $sheetData[$baseRow]['D'];
						$id_talent=  $sheetData[$baseRow]['E'];
						$id_karier=  $sheetData[$baseRow]['F'];
						$id_absen=  $sheetData[$baseRow]['G'];
						$jenis_reward=  $sheetData[$baseRow]['H'];
						$keterangan_reward=  $sheetData[$baseRow]['I'];
						$jumlah=  $sheetData[$baseRow]['J'];
						$tgl_data=  $sheetData[$baseRow]['L'];

						$model2=new DataKompensasi;
						//$model2->id_kompensasi=  $id_kompensasi;
						$model2->nip=  $nip;
						$model2->nama_lengkap=  $nama_lengkap;
						$model2->id_jabatan=  $id_jabatan;
						$model2->id_talent=  $id_talent;
						$model2->id_karier=  $id_karier;
						$model2->id_absen=  $id_absen;
						$model2->jenis_reward=  $jenis_reward;
						$model2->keterangan_reward=  $keterangan_reward;
						$model2->jumlah=  $jumlah;
						$model2->tgl_data=  $tgl_data;

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
	    $es = new TbEditableSaver('DataKompensasi'); 
			    $es->update();
	}

	public function actions()
	{
    	return array(
        		'toggle' => array(
                	'class'=>'bootstrap.actions.TbToggleAction',
                	'modelName' => 'DataKompensasi',
        		)
    	);
	}

	public function actionLookuppegawai()
	{
		$id_jabatan = $_POST['DataKompensasi']['id_jabatan'];
		$list = Personal::model()->findAllBySql('SELECT * FROM personal WHERE id_jabatan=:id_jabatan', array(':id_jabatan'=>$id_jabatan));
		$list = CHtml::listData($list,'nip','nama_lengkap');
		echo CHtml::tag('option',array('value'=>''),'Pilihan NIP Pegawai', true);
		foreach($list as $value=>$nama){
			echo CHtml::tag('option',array('value'=>$value),CHtml::encode($nama), true);
		}
	}

	
}
