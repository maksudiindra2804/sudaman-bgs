<?php

class DataProjectController extends Controller
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
				'actions'=>array('index','view','delete','updateuser','exportuser'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','export','import','editable','toggle','calendar', 'calendarEvents','create' ),
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
				
		$model=new DataProject;
	//	$model = new Personal;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DataProject']))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try{
				$messageType='warning';
				$message = "There are some errors ";
				$model->attributes=$_POST['DataProject'];
				//$uploadFile=CUploadedFile::getInstance($model,'filename');
				if($model->save()){
					$messageType = 'info';
					$message = "<strong>Anda berhasil menambah data riwayat pendidikan</strong>";
					$total = count($_POST['nama_project']);
		    		for ($i = 0; $i <= $total; $i++)
		    		{
		    			if(isset($_POST['nama_project'][$i]))
		    			{
		     				$jiakakak = new DataProject;
		     				$jiakakak->nip=$model->nip;
		        			$jiakakak->nama_project = $_POST['nama_project'][$i];
		        			$jiakakak->tgl_project = $_POST['tgl_project'][$i];
		        			$jiakakak->rilis_project = $_POST['rilis_project'][$i];
		        			$jiakakak->status = $_POST['status'][$i];
		        			$jiakakak->no=$i;
		         			$jiakakak->save();
		    			}	
					}
					$transaction->commit();
					Yii::app()->user->setFlash($messageType, $message);
					$this->redirect(array('admin','id'=>$model->id_project));
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
		$model2=new DataProject;
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DataProject']))
		{
			$messageType='warning';
			$message = "There are some errors ";
			$transaction = Yii::app()->db->beginTransaction();
			try{
				$model->attributes=$_POST['DataProject'];
				$messageType = 'info';
				$message = "<strong>Anda berhasil merubah data riwayat pekerjaan.</strong>";

				if($model->save()){
					$transaction->commit();
					$total = count($_POST['nama_project']);
		    		for ($i = 0; $i <= $total; $i++)
		    		{
		    			if(isset($_POST['nama_project'][$i]))
		    			{
		     				$jiakakak2 = new DataProject;
		     				$jiakakak2->nip=$model->nip;
		        			$jiakakak2->nama_project = $_POST['nama_project'][$i];
		        			$jiakakak2->tgl_project = $_POST['tgl_project'][$i];
		        			$jiakakak2->rilis_project = $_POST['rilis_project'][$i];
		        			$jiakakak2->status = $_POST['status'][$i];
		        			$jiakakak2->no=$i;
		         			$jiakakak2->save();
		    			}	
					}
					Yii::app()->user->setFlash($messageType, $message);
					$this->redirect(array('update','id'=>$model->id_project));
				}
			}
			catch (Exception $e){
				$transaction->rollBack();
				Yii::app()->user->setFlash('error', "{$e->getMessage()}");
				// $this->refresh(); 
			}

			$model->attributes=$_POST['DataProject'];
			if($model->save())
				$this->redirect(array('update','id'=>$model->id_project));
		}

		$this->render('update',array(
			'model'=>$model,'model2'=>$model2
					));
		
			}

		public function actionUpdateuser($id)
		{
		$model2=new DataProject;
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DataProject']))
		{
			$messageType='warning';
			$message = "There are some errors ";
			$transaction = Yii::app()->db->beginTransaction();
			try{
				$model->attributes=$_POST['DataProject'];
				$messageType = 'info';
				$message = "<strong>Anda berhasil merubah data riwayat pekerjaan.</strong>";

				if($model->save()){
					$transaction->commit();
					$total = count($_POST['nama_project']);
		    		for ($i = 0; $i <= $total; $i++)
		    		{
		    			if(isset($_POST['nama_project'][$i]))
		    			{
		     				$jiakakak2 = new DataProject;
		     				$jiakakak2->nip=$model->nip;
		        			$jiakakak2->nama_project = $_POST['nama_project'][$i];
		        			$jiakakak2->tgl_project = $_POST['tgl_project'][$i];
		        			$jiakakak2->rilis_project = $_POST['rilis_project'][$i];
		        			$jiakakak2->status = $_POST['status'][$i];
		        			$jiakakak2->no=$i;
		         			$jiakakak2->save();
		    			}	
					}
					Yii::app()->user->setFlash($messageType, $message);
					$this->redirect(array('updateuser','id'=>$model->id_project));
				}
			}
			catch (Exception $e){
				$transaction->rollBack();
				Yii::app()->user->setFlash('error', "{$e->getMessage()}");
				// $this->refresh(); 
			}

			$model->attributes=$_POST['DataProject'];
			if($model->save())
				$this->redirect(array('updateuser','id'=>$model->id_project));
		}

		$this->render('updateuser',array(
			'model'=>$model,'model2'=>$model2
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
				//$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
				$this->redirect($_SERVER['HTTP_REFERER']);
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
		$dataProvider=new CActiveDataProvider('DataProject');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
		*/
		
		$model=new DataProject('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DataProject']))
			$model->attributes=$_GET['DataProject'];

		$this->render('index',array(
			'model'=>$model,
					));
		
			}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		
		$model=new DataProject('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DataProject']))
			$model->attributes=$_GET['DataProject'];

		$this->render('admin',array(
			'model'=>$model,
					));
		
			}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return DataProject the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=DataProject::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param DataProject $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='data-project-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionExport()
    {
        $model=new DataProject;
		$model->unsetAttributes();  // clear any default values
		if(isset($_POST['DataProject']))
			$model->attributes=$_POST['DataProject'];

		$exportType = $_POST['fileType'];
        $this->widget('ext.heart.export.EHeartExport', array(
            'title'=>'Data Riwayat Pekerjaan',
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
            		'header'=>'Nama Proyek',
            		'name'=>'nama_project',
            		'value'=>'$data->nama_project',
            	),

            	array(
            		'header'=>'Tanggal Proyek',
            		'name'=>'tgl_project',
            		'value'=>'$data->tgl_project',
            	),

            	array(
            		'header'=>'Tanggal Rilis Proyek',
            		'name'=>'rilis_project',
            		'value'=>'$data->rilis_project',
            	),

            	array(
            		'header'=>'Status Proyek',
            		'name'=>'status',
            		'value'=>'$data->status',
            	),
	            ),
        ));
    }

    public function actionExportuser()
    {
        $model=new DataProject;
		$model->unsetAttributes();  // clear any default values
		if(isset($_POST['DataProject']))
			$model->attributes=$_POST['DataProject'];

		$exportType = $_POST['fileType'];
        $this->widget('ext.heart.export.EHeartExport', array(
            'title'=>'Data Riwayat Pekerjaan',
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
            		'header'=>'Nama Proyek',
            		'name'=>'nama_project',
            		'value'=>'$data->nama_project',
            	),

            	array(
            		'header'=>'Tanggal Proyek',
            		'name'=>'tgl_project',
            		'value'=>'$data->tgl_project',
            	),

            	array(
            		'header'=>'Tanggal Rilis Proyek',
            		'name'=>'rilis_project',
            		'value'=>'$data->rilis_project',
            	),

            	array(
            		'header'=>'Status Proyek',
            		'name'=>'status',
            		'value'=>'$data->status',
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
		
		$model=new DataProject;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DataProject']))
		{
			if (!empty($_FILES)) {
				$tempFile = $_FILES['DataProject']['tmp_name']['fileImport'];
				$fileTypes = array('xls','xlsx'); // File extensions
				$fileParts = pathinfo($_FILES['DataProject']['name']['fileImport']);
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
						//$id_project=  $sheetData[$baseRow]['A'];
						$nama_project=  $sheetData[$baseRow]['B'];
						$tgl_project=  $sheetData[$baseRow]['C'];
						$rilis_project=  $sheetData[$baseRow]['D'];
						$status=  $sheetData[$baseRow]['E'];
						$nip=  $sheetData[$baseRow]['F'];
						$no=  $sheetData[$baseRow]['G'];

						$model2=new DataProject;
						//$model2->id_project=  $id_project;
						$model2->nama_project=  $nama_project;
						$model2->tgl_project=  $tgl_project;
						$model2->rilis_project=  $rilis_project;
						$model2->status=  $status;
						$model2->nip=  $nip;
						$model2->no=  $no;

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
	    $es = new TbEditableSaver('DataProject'); 
			    $es->update();
	}

	public function actions()
	{
    	return array(
        		'toggle' => array(
                	'class'=>'bootstrap.actions.TbToggleAction',
                	'modelName' => 'DataProject',
        		)
    	);
	}

	
	public function actionCalendar()
	{
		$model=new DataProject('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DataProject']))
			$model->attributes=$_GET['DataProject'];
		$this->render('calendar',array(
			'model'=>$model,
		));	
	}

	public function actionCalendarEvents()
	{	 	
	 	$items = array();
	 	$model=DataProject::model()->findAll();	
		foreach ($model as $value) {
			$items[]=array(
				'id'=>$value->id_project,
								
				//'color'=>'#CC0000',
	        	//'allDay'=>true,
	        	'url'=>'#',
			);
		}
	    echo CJSON::encode($items);
	    Yii::app()->end();
	}

	
}
