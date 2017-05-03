<?php

class DataKarierController extends Controller
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
				
		$model=new DataKarier;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DataKarier']))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try{
				$messageType='warning';
				$message = "There are some errors ";
				$model->attributes=$_POST['DataKarier'];
				//$uploadFile=CUploadedFile::getInstance($model,'filename');
				if($model->save()){
					$messageType = 'info';
					$message = "<strong>Anda berhasil menambah data Karier.</strong>";
					/*
					$model2 = DataKarier::model()->findByPk($model->id_karier);						
					if(!empty($uploadFile)) {
						$extUploadFile = substr($uploadFile, strrpos($uploadFile, '.')+1);
						if(!empty($uploadFile)) {
							if($uploadFile->saveAs(Yii::app()->basePath.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'datakarier'.DIRECTORY_SEPARATOR.$model2->id_karier.DIRECTORY_SEPARATOR.$model2->id_karier.'.'.$extUploadFile)){
								$model2->filename=$model2->id_karier.'.'.$extUploadFile;
								$model2->save();
								$message .= 'and file uploded';
							}
							else{
								$messageType = 'warning';
								$message .= 'but file not uploded';
							}
						}						
					}
					*/
					$transaction->commit();
					Yii::app()->user->setFlash($messageType, $message);
					$this->redirect(array('admin','id'=>$model->id_karier));
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DataKarier']))
		{
			$messageType='warning';
			$message = "There are some errors ";
			$transaction = Yii::app()->db->beginTransaction();
			try{
				$model->attributes=$_POST['DataKarier'];
				$messageType = 'info';
				$message = "<strong>Anda berhasil merubah data Karier.</strong>";

				/*
				$uploadFile=CUploadedFile::getInstance($model,'filename');
				if(!empty($uploadFile)) {
					$extUploadFile = substr($uploadFile, strrpos($uploadFile, '.')+1);
					if(!empty($uploadFile)) {
						if($uploadFile->saveAs(Yii::app()->basePath.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'datakarier'.DIRECTORY_SEPARATOR.$model->id_karier.DIRECTORY_SEPARATOR.$model->id_karier.'.'.$extUploadFile)){
							$model->filename=$model->id_karier.'.'.$extUploadFile;
							$message .= 'and file uploded';
						}
						else{
							$messageType = 'warning';
							$message .= 'but file not uploded';
						}
					}						
				}
				*/

				if($model->save()){
					$transaction->commit();
					Yii::app()->user->setFlash($messageType, $message);
					$this->redirect(array('admin','id'=>$model->id_karier));
				}
			}
			catch (Exception $e){
				$transaction->rollBack();
				Yii::app()->user->setFlash('error', "{$e->getMessage()}");
				// $this->refresh(); 
			}

			$model->attributes=$_POST['DataKarier'];
			if($model->save())
				$this->redirect(array('admin','id'=>$model->id_karier));
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
		$dataProvider=new CActiveDataProvider('DataKarier');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
		*/
		
		$model=new DataKarier('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DataKarier']))
			$model->attributes=$_GET['DataKarier'];

		$this->render('index',array(
			'model'=>$model,
					));
		
			}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		
		$model=new DataKarier('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DataKarier']))
			$model->attributes=$_GET['DataKarier'];

		$this->render('admin',array(
			'model'=>$model,
					));
		
			}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return DataKarier the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=DataKarier::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param DataKarier $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='data-karier-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionExport()
    {
        $model=new DataKarier;
		$model->unsetAttributes();  // clear any default values
		if(isset($_POST['DataKarier']))
			$model->attributes=$_POST['DataKarier'];

		$exportType = $_POST['fileType'];
        $this->widget('ext.heart.export.EHeartExport', array(
            'title'=>'Data Pelatihan Karier',
            'dataProvider' => $model->search(),
            'filter'=>$model,
            'grid_mode'=>'export',
            'exportType'=>$exportType,
            'columns' => array(

            	array(
            		'label'=>'NIP Pegawai',
            		'name'=>'nip',
            		'value'=>$model->nip0->nip,
            	),

            	array(
            		'label'=>'Nama Lengkap',
            		'name'=>'nama_lengkap',
            		'value'=>$model->nip0->nama_lengkap,
            	),

            	array(
            		'label'=>'Jabatan',
            		'name'=>'id_jabatan',
            		'value'=>$model->idJabatan->nama_jabatan,
            	),

            	array(
            		'label'=>'Tanggal Pelatihan',
            		'name'=>'tgl_pelatihan',
            		'value'=>$model->tgl_pelatihan,
            	),

            	array(
            		'label'=>'Deskripsi Pelatihan Karier',
            		'name'=>'deskripsi',
            		'value'=>$model->deskripsi,
            	),

            	array(
            		'label'=>'Keterangan Pelatihan Karier',
            		'name'=>'keterangan',
            		'value'=>$model->keterangan,
            	),

            	array(
            		'label'=>'Mapping Kompetensi',
            		'name'=>'id_mapping',
            		'value'=>$model->idMapping->mapping,
            	),

            	array(
            		'label'=>'Detail Mapping Kompetensi',
            		'name'=>'id_mapping',
            		'value'=>$model->idMapping->child_mapping,
            	),

            	array(
            		'label'=>'Status',
            		'name'=>'status',
            		'value'=>$model->status,
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
		
		$model=new DataKarier;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DataKarier']))
		{
			if (!empty($_FILES)) {
				$tempFile = $_FILES['DataKarier']['tmp_name']['fileImport'];
				$fileTypes = array('xls','xlsx'); // File extensions
				$fileParts = pathinfo($_FILES['DataKarier']['name']['fileImport']);
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
						//$id_karier=  $sheetData[$baseRow]['A'];
						$id_talent=  $sheetData[$baseRow]['B'];
						$nip=  $sheetData[$baseRow]['C'];
						$id_jabatan=  $sheetData[$baseRow]['D'];
						$nama_lengkap=  $sheetData[$baseRow]['E'];
						$tgl_data=  $sheetData[$baseRow]['F'];
						$tgl_pelatihan=  $sheetData[$baseRow]['G'];
						$status=  $sheetData[$baseRow]['H'];
						$keterangan=  $sheetData[$baseRow]['I'];
						$deskripsi=  $sheetData[$baseRow]['J'];

						$model2=new DataKarier;
						//$model2->id_karier=  $id_karier;
						$model2->id_talent=  $id_talent;
						$model2->nip=  $nip;
						$model2->id_jabatan=  $id_jabatan;
						$model2->nama_lengkap=  $nama_lengkap;
						$model2->tgl_data=  $tgl_data;
						$model2->tgl_pelatihan=  $tgl_pelatihan;
						$model2->status=  $status;
						$model2->keterangan=  $keterangan;
						$model2->deskripsi=  $deskripsi;

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
	    $es = new TbEditableSaver('DataKarier'); 
			    $es->update();
	}

	public function actions()
	{
    	return array(
        		'toggle' => array(
                	'class'=>'bootstrap.actions.TbToggleAction',
                	'modelName' => 'DataKarier',
        		)
    	);
	}

	public function actionLookuppegawai()
	{
		$id_jabatan = $_POST['DataKarier']['id_jabatan'];
		$list = Personal::model()->findAllBySql('SELECT * FROM personal WHERE id_jabatan=:id_jabatan', array(':id_jabatan'=>$id_jabatan));
		$list = CHtml::listData($list,'nip','nama_lengkap');
		echo CHtml::tag('option',array('value'=>''),'Pilihan Jabatan Pegawai', true);
		foreach($list as $value=>$nama){
			echo CHtml::tag('option',array('value'=>$value),CHtml::encode($nama), true);
		}
	}
	
}
