<?php

class DataTalentController extends Controller
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
				'actions'=>array('index','viewuser','create','view','exportuser'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','export','import','editable','toggle','create','lookuppegawai','view'),
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

	public function actionViewuser()
 	{
 		//$sql='SELECT * FROM tbl_absensi';

	$model = new DataTalent('search2');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DataTalent']))
			$model->attributes=$_GET['DataTalent'];
		$this->render('viewuser',array('model'=>$model));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
				
		$model = new DataTalent;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DataTalent']))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try{
				$messageType='warning';
				$message = "There are some errors ";
				$model->attributes=$_POST['DataTalent'];
				//$uploadFile=CUploadedFile::getInstance($model,'filename');
				if($model->save()){
					$messageType = 'info';
					$message = "<strong>Anda berhasil menambah data Talenta</strong>";

					$transaction->commit();
					Yii::app()->user->setFlash($messageType, $message);
					$this->redirect(array('view','id'=>$model->id_talent));
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

		if(isset($_POST['DataTalent']))
		{
			$messageType='warning';
			$message = "There are some errors ";
			$transaction = Yii::app()->db->beginTransaction();
			try{
				$model->attributes=$_POST['DataTalent'];
				$messageType = 'success';
				$message = "<strong>Well done!</strong> You successfully update data ";

				if($model->save()){
					$transaction->commit();
					Yii::app()->user->setFlash($messageType, $message);
					$this->redirect(array('view','id'=>$model->id_talent));
				}
			}
			catch (Exception $e){
				$transaction->rollBack();
				Yii::app()->user->setFlash('error', "{$e->getMessage()}");
				// $this->refresh(); 
			}

			$model->attributes=$_POST['DataTalent'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_talent));
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
		$dataProvider=new CActiveDataProvider('DataTalent');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
		*/
		
		$model=new DataTalent('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DataTalent']))
			$model->attributes=$_GET['DataTalent'];

		$this->render('index',array(
			'model'=>$model,
					));
		
			}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		
		$model=new DataTalent('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DataTalent']))
			$model->attributes=$_GET['DataTalent'];

		$this->render('admin',array(
			'model'=>$model,
					));
		
			}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return DataTalent the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=DataTalent::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param DataTalent $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='data-talent-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionExport()
    {
        $model=new DataTalent;
		$model->unsetAttributes();  // clear any default values
		if(isset($_POST['DataTalent']))
			$model->attributes=$_POST['DataTalent'];

		$exportType = $_POST['fileType'];
        $this->widget('ext.heart.export.EHeartExport', array(
            'title'=>'Data Pelatihan Talenta',
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
            		'name'=>'nama_lengkap',
            		'value'=>'$data->nip0->nama_lengkap',
            	),

            	array(
            		'header'=>'Jabatan',
            		'name'=>'id_jabatan',
            		'value'=>'$data->idJabatan->nama_jabatan',
            	),

            	array(
            		'header'=>'Jenis Pelatihan',
            		'name'=>'id_pelatihan',
            		'value'=>'$data->idPelatihan->jenis',
            	),

            	array(
            		'header'=>'Kategori Pelatihan',
            		'name'=>'id_kategori',
            		'value'=>'$data->idKategori->kategori',
            	),

            	array(
            		'header'=>'Tanggal Mulai Penyelenggaraan',
            		'name'=>'tgl_mulai',
            		'value'=>'$data->tgl_mulai',
            	),

            	array(
            		'header'=>'Tanggal Selesai Penyelenggaraan',
            		'name'=>'tgl_selesai',
            		'value'=>'$data->tgl_selesai',
            	),

            	array(
            		'header'=>'Status Pelatihan',
            		'name'=>'status',
            		'value'=>'$data->status',
            	),

            	array(
            		'header'=>'Tempat Penyelenggaraan',
            		'name'=>'tempat',
            		'value'=>'$data->tempat',
            	),

            	array(
            		'header'=>'Durasi Pelatihan',
            		'name'=>'durasi',
            		'value'=>'$data->durasi',
            	),

            	array(
            		'header'=>'Keterangan Pelatihan',
            		'name'=>'keterangan',
            		'value'=>'$data->keterangan',
            	),

            	array(
            		'header'=>'Nama Trainner',
            		'name'=>'kode_trainner',
            		'value'=>'$data->kodeTrainner->nama_trainner',
            	),
	            ),
        ));
    }

    public function actionExportuser()
    {
        $model=new DataTalent;
		$model->unsetAttributes();  // clear any default values
		if(isset($_POST['DataTalent']))
			$model->attributes=$_POST['DataTalent'];

		$exportType = $_POST['fileType'];
        $this->widget('ext.heart.export.EHeartExport', array(
            'title'=>'Data Pelatihan Talenta',
            'dataProvider' => $model->search($model->nip=Yii::app()->user->getId()),
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
            		'name'=>'nama_lengkap',
            		'value'=>'$data->nip0->nama_lengkap',
            	),

            	array(
            		'header'=>'Jabatan',
            		'name'=>'id_jabatan',
            		'value'=>'$data->idJabatan->nama_jabatan',
            	),

            	array(
            		'header'=>'Jenis Pelatihan',
            		'name'=>'id_pelatihan',
            		'value'=>'$data->idPelatihan->jenis',
            	),

            	array(
            		'header'=>'Kategori Pelatihan',
            		'name'=>'id_kategori',
            		'value'=>'$data->idKategori->kategori',
            	),

            	array(
            		'header'=>'Tanggal Mulai Penyelenggaraan',
            		'name'=>'tgl_mulai',
            		'value'=>'$data->tgl_mulai',
            	),

            	array(
            		'header'=>'Tanggal Selesai Penyelenggaraan',
            		'name'=>'tgl_selesai',
            		'value'=>'$data->tgl_selesai',
            	),

            	array(
            		'header'=>'Status Pelatihan',
            		'name'=>'status',
            		'value'=>'$data->status',
            	),

            	array(
            		'header'=>'Tempat Penyelenggaraan',
            		'name'=>'tempat',
            		'value'=>'$data->tempat',
            	),

            	array(
            		'header'=>'Durasi Pelatihan',
            		'name'=>'durasi',
            		'value'=>'$data->durasi',
            	),

            	array(
            		'header'=>'Keterangan Pelatihan',
            		'name'=>'keterangan',
            		'value'=>'$data->keterangan',
            	),

            	array(
            		'header'=>'Nama Trainner',
            		'name'=>'kode_trainner',
            		'value'=>'$data->kodeTrainner->nama_trainner',
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
		
		$model=new DataTalent;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DataTalent']))
		{
			if (!empty($_FILES)) {
				$tempFile = $_FILES['DataTalent']['tmp_name']['fileImport'];
				$fileTypes = array('xls','xlsx'); // File extensions
				$fileParts = pathinfo($_FILES['DataTalent']['name']['fileImport']);
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
						//$id_talent=  $sheetData[$baseRow]['A'];
						$id_jabatan=  $sheetData[$baseRow]['B'];
						$nip=  $sheetData[$baseRow]['C'];
						$nama_lengkap=  $sheetData[$baseRow]['D'];
						$id_pelatihan=  $sheetData[$baseRow]['E'];

						$model2=new DataTalent;
						//$model2->id_talent=  $id_talent;
						$model2->id_jabatan=  $id_jabatan;
						$model2->nip=  $nip;
						$model2->nama_lengkap=  $nama_lengkap;
						$model2->id_pelatihan=  $id_pelatihan;

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
	    $es = new TbEditableSaver('DataTalent'); 
			    $es->update();
	}

	public function actions()
	{
    	return array(
        		'toggle' => array(
                	'class'=>'bootstrap.actions.TbToggleAction',
                	'modelName' => 'DataTalent',
        		)
    	);
	}

	public function actionLookuppegawai()
	{
		$id_jabatan = $_POST['DataTalent']['id_jabatan'];
		$list = Personal::model()->findAllBySql('SELECT * FROM personal WHERE id_jabatan=:id_jabatan', array(':id_jabatan'=>$id_jabatan));
		$list = CHtml::listData($list,'nip','nama_lengkap');
		echo CHtml::tag('option',array('value'=>''),'Pilihan Jabatan Pegawai', true);
		foreach($list as $value=>$nama){
			echo CHtml::tag('option',array('value'=>$value),CHtml::encode($nama), true);
		}
	}
	
}
