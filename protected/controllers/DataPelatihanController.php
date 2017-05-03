<?php

class DataPelatihanController extends Controller
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
				'actions'=>array('admin','delete','export','import','editable','toggle','create'),
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
				
		$model=new DataPelatihan;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DataPelatihan']))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try{
				$messageType='warning';
				$message = "There are some errors ";
				$model->attributes=$_POST['DataPelatihan'];
				//$uploadFile=CUploadedFile::getInstance($model,'filename');
				if($model->save()){
					$messageType = 'success';
					$message = "<strong>Well done!</strong> You successfully create data ";
					/*
					$model2 = DataPelatihan::model()->findByPk($model->id_pelatihan);						
					if(!empty($uploadFile)) {
						$extUploadFile = substr($uploadFile, strrpos($uploadFile, '.')+1);
						if(!empty($uploadFile)) {
							if($uploadFile->saveAs(Yii::app()->basePath.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'datapelatihan'.DIRECTORY_SEPARATOR.$model2->id_pelatihan.DIRECTORY_SEPARATOR.$model2->id_pelatihan.'.'.$extUploadFile)){
								$model2->filename=$model2->id_pelatihan.'.'.$extUploadFile;
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
					$this->redirect(array('view','id'=>$model->id_pelatihan));
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

		if(isset($_POST['DataPelatihan']))
		{
			$messageType='warning';
			$message = "There are some errors ";
			$transaction = Yii::app()->db->beginTransaction();
			try{
				$model->attributes=$_POST['DataPelatihan'];
				$messageType = 'success';
				$message = "<strong>Well done!</strong> You successfully update data ";

				/*
				$uploadFile=CUploadedFile::getInstance($model,'filename');
				if(!empty($uploadFile)) {
					$extUploadFile = substr($uploadFile, strrpos($uploadFile, '.')+1);
					if(!empty($uploadFile)) {
						if($uploadFile->saveAs(Yii::app()->basePath.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'datapelatihan'.DIRECTORY_SEPARATOR.$model->id_pelatihan.DIRECTORY_SEPARATOR.$model->id_pelatihan.'.'.$extUploadFile)){
							$model->filename=$model->id_pelatihan.'.'.$extUploadFile;
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
					$this->redirect(array('view','id'=>$model->id_pelatihan));
				}
			}
			catch (Exception $e){
				$transaction->rollBack();
				Yii::app()->user->setFlash('error', "{$e->getMessage()}");
				// $this->refresh(); 
			}

			$model->attributes=$_POST['DataPelatihan'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_pelatihan));
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
		$dataProvider=new CActiveDataProvider('DataPelatihan');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
		*/
		
		$model=new DataPelatihan('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DataPelatihan']))
			$model->attributes=$_GET['DataPelatihan'];

		$this->render('index',array(
			'model'=>$model,
					));
		
			}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		
		$model=new DataPelatihan('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DataPelatihan']))
			$model->attributes=$_GET['DataPelatihan'];

		$this->render('admin',array(
			'model'=>$model,
					));
		
			}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return DataPelatihan the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=DataPelatihan::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param DataPelatihan $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='data-pelatihan-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionExport()
    {
        $model=new DataPelatihan;
		$model->unsetAttributes();  // clear any default values
		if(isset($_POST['DataPelatihan']))
			$model->attributes=$_POST['DataPelatihan'];

		$exportType = $_POST['fileType'];
        $this->widget('ext.heart.export.EHeartExport', array(
            'title'=>'List of DataPelatihan',
            'dataProvider' => $model->search(),
            'filter'=>$model,
            'grid_mode'=>'export',
            'exportType'=>$exportType,
            'columns' => array(
	                
					'id_pelatihan',
					'jenis',
					'tgl_data',
					'status',
	            ),
        ));
    }

    /**
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionImport()
	{
		
		$model=new DataPelatihan;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DataPelatihan']))
		{
			if (!empty($_FILES)) {
				$tempFile = $_FILES['DataPelatihan']['tmp_name']['fileImport'];
				$fileTypes = array('xls','xlsx'); // File extensions
				$fileParts = pathinfo($_FILES['DataPelatihan']['name']['fileImport']);
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
						//$id_pelatihan=  $sheetData[$baseRow]['A'];
						$jenis=  $sheetData[$baseRow]['B'];
						$tgl_data=  $sheetData[$baseRow]['C'];
						$status=  $sheetData[$baseRow]['D'];

						$model2=new DataPelatihan;
						//$model2->id_pelatihan=  $id_pelatihan;
						$model2->jenis=  $jenis;
						$model2->tgl_data=  $tgl_data;
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
	    $es = new TbEditableSaver('DataPelatihan'); 
			    $es->update();
	}

	public function actions()
	{
    	return array(
        		'toggle' => array(
                	'class'=>'bootstrap.actions.TbToggleAction',
                	'modelName' => 'DataPelatihan',
        		)
    	);
	}
	
}
