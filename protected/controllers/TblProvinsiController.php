<?php

class TblProvinsiController extends Controller
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
				'actions'=>array('index','view','lookupprovinsi'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','export','import','editable','toggle','calendar', 'calendarEvents','lookupprovinsi' ),
				'users'=>array('admin'),
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
				
		$model=new TblProvinsi;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TblProvinsi']))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try{
				$messageType='warning';
				$message = "There are some errors ";
				$model->attributes=$_POST['TblProvinsi'];
				//$uploadFile=CUploadedFile::getInstance($model,'filename');
				if($model->save()){
					$messageType = 'success';
					$message = "<strong>Well done!</strong> You successfully create data ";
					/*
					$model2 = TblProvinsi::model()->findByPk($model->provinsi_id);						
					if(!empty($uploadFile)) {
						$extUploadFile = substr($uploadFile, strrpos($uploadFile, '.')+1);
						if(!empty($uploadFile)) {
							if($uploadFile->saveAs(Yii::app()->basePath.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'tblprovinsi'.DIRECTORY_SEPARATOR.$model2->provinsi_id.DIRECTORY_SEPARATOR.$model2->provinsi_id.'.'.$extUploadFile)){
								$model2->filename=$model2->provinsi_id.'.'.$extUploadFile;
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
					$this->redirect(array('view','id'=>$model->provinsi_id));
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

		if(isset($_POST['TblProvinsi']))
		{
			$messageType='warning';
			$message = "There are some errors ";
			$transaction = Yii::app()->db->beginTransaction();
			try{
				$model->attributes=$_POST['TblProvinsi'];
				$messageType = 'success';
				$message = "<strong>Well done!</strong> You successfully update data ";

				/*
				$uploadFile=CUploadedFile::getInstance($model,'filename');
				if(!empty($uploadFile)) {
					$extUploadFile = substr($uploadFile, strrpos($uploadFile, '.')+1);
					if(!empty($uploadFile)) {
						if($uploadFile->saveAs(Yii::app()->basePath.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'tblprovinsi'.DIRECTORY_SEPARATOR.$model->provinsi_id.DIRECTORY_SEPARATOR.$model->provinsi_id.'.'.$extUploadFile)){
							$model->filename=$model->provinsi_id.'.'.$extUploadFile;
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
					$this->redirect(array('view','id'=>$model->provinsi_id));
				}
			}
			catch (Exception $e){
				$transaction->rollBack();
				Yii::app()->user->setFlash('error', "{$e->getMessage()}");
				// $this->refresh(); 
			}

			$model->attributes=$_POST['TblProvinsi'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->provinsi_id));
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
		$dataProvider=new CActiveDataProvider('TblProvinsi');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
		*/
		
		$model=new TblProvinsi('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TblProvinsi']))
			$model->attributes=$_GET['TblProvinsi'];

		$this->render('index',array(
			'model'=>$model,
					));
		
			}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		
		$model=new TblProvinsi('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TblProvinsi']))
			$model->attributes=$_GET['TblProvinsi'];

		$this->render('admin',array(
			'model'=>$model,
					));
		
			}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TblProvinsi the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TblProvinsi::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TblProvinsi $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tbl-provinsi-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionExport()
    {
        $model=new TblProvinsi;
		$model->unsetAttributes();  // clear any default values
		if(isset($_POST['TblProvinsi']))
			$model->attributes=$_POST['TblProvinsi'];

		$exportType = $_POST['fileType'];
        $this->widget('ext.heart.export.EHeartExport', array(
            'title'=>'List of TblProvinsi',
            'dataProvider' => $model->search(),
            'filter'=>$model,
            'grid_mode'=>'export',
            'exportType'=>$exportType,
            'columns' => array(
	                
					'provinsi_id',
					'nama_provinsi',
					'create_at',
	            ),
        ));
    }

    /**
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionImport()
	{
		
		$model=new TblProvinsi;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TblProvinsi']))
		{
			if (!empty($_FILES)) {
				$tempFile = $_FILES['TblProvinsi']['tmp_name']['fileImport'];
				$fileTypes = array('xls','xlsx'); // File extensions
				$fileParts = pathinfo($_FILES['TblProvinsi']['name']['fileImport']);
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
						$provinsi_id=  $sheetData[$baseRow]['A'];
						$nama_provinsi=  $sheetData[$baseRow]['B'];
						$create_at=  $sheetData[$baseRow]['C'];

						$model2=new TblProvinsi;
						$model2->provinsi_id=  $provinsi_id;
						$model2->nama_provinsi=  $nama_provinsi;
						$model2->create_at=  $create_at;

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
	    $es = new TbEditableSaver('TblProvinsi'); 
			    $es->update();
	}

	public function actions()
	{
    	return array(
        		'toggle' => array(
                	'class'=>'bootstrap.actions.TbToggleAction',
                	'modelName' => 'TblProvinsi',
        		)
    	);
	}

	
	public function actionCalendar()
	{
		$model=new TblProvinsi('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TblProvinsi']))
			$model->attributes=$_GET['TblProvinsi'];
		$this->render('calendar',array(
			'model'=>$model,
		));	
	}

	public function actionCalendarEvents()
	{	 	
	 	$items = array();
	 	$model=TblProvinsi::model()->findAll();	
		foreach ($model as $value) {
			$items[]=array(
				'id'=>$value->provinsi_id,
								
				//'color'=>'#CC0000',
	        	//'allDay'=>true,
	        	'url'=>'#',
			);
		}
	    echo CJSON::encode($items);
	    Yii::app()->end();
	}

	public function actionLookupprovinsi()
	{
		$id_provinsi = $_POST['TblPersonal']['provinsi_id'];
		//$st = $_POST['TblPersonal']['id_kotkab'];

		// $list = TblProdi::model()->findAll('fak_id = :provinsi_id', array(':provinsi_id'=>$provinsi_id));
		$list = TblKotkab::model()->findAllBySql('SELECT * FROM tbl_kotkab WHERE provinsi_id=:id_provinsi', array(':id_provinsi'=>$id_provinsi));
		$list = CHtml::listData($list,'id_kotkab','nama_kotkab');
		echo CHtml::tag('option',array('value'=>''),'Pilihan Kota/Kabupaten', true);
		foreach($list as $value=>$nama){
			echo CHtml::tag('option',array('value'=>$value),CHtml::encode($nama), true);
		}
	}

	
}
