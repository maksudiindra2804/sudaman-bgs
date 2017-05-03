<?php

class DataPendidikanController extends Controller
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
				'actions'=>array('index','view','create','delete','updateuser','exportuser'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','export','import','editable','toggle','create','exportadmin'),
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
				
		$model=new DataPendidikan;
		if(isset($_POST['DataPendidikan']))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try{
				$messageType='warning';
				$message = "There are some errors ";
				$model->attributes=$_POST['DataPendidikan'];

				if($model->save()){
					$messageType = 'info';
					$message = "<strong>Anda berhasil menambah data riwayat pendidikan.</strong> ";
					$total = count($_POST['tahun1']);
		    		for ($i = 0; $i <= $total; $i++)
		    		{
		    			if(isset($_POST['tahun1'][$i]))
		    			{
		     				$jiakakak = new DataPendidikan;
		     				$jiakakak->nip=$model->nip;
		        			$jiakakak->tahun1 = $_POST['tahun1'][$i];
		        			$jiakakak->tahun2 = $_POST['tahun2'][$i];
		        			$jiakakak->riwayat = $_POST['riwayat'][$i];
		        			$jiakakak->no=$i;
		         			$jiakakak->save();
		    			}	
					}
					$transaction->commit();
					Yii::app()->user->setFlash($messageType, $message);
					$this->redirect(array('admin'));
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
		$model2=new DataPendidikan;
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DataPendidikan']))
		{
			$messageType='warning';
			$message = "There are some errors ";
			$transaction = Yii::app()->db->beginTransaction();
			try{
				$model->attributes=$_POST['DataPendidikan'];
				$messageType = 'info';
				$message = "<strong>Anda berhasil merubah data riwayat pendidikan.</strong> ";

				if($model->save()){
					$transaction->commit();
					$total = count($_POST['tahun1']);
		    		for ($i = 0; $i <= $total; $i++)
		    		{
		    			if(isset($_POST['tahun1'][$i]))
		    			{
		     				$jiakakak = new DataPendidikan;
		     				$jiakakak->nip=$model->nip;
		        			$jiakakak->tahun1 = $_POST['tahun1'][$i];
		        			$jiakakak->tahun2 = $_POST['tahun2'][$i];
		        			$jiakakak->riwayat = $_POST['riwayat'][$i];
		        			$jiakakak->no=$i;
		         			$jiakakak->save();
		    			}	
					}
					Yii::app()->user->setFlash($messageType, $message);
					$this->redirect(array('update','id'=>$model->id));
				}
			}
			catch (Exception $e){
				$transaction->rollBack();
				Yii::app()->user->setFlash('error', "{$e->getMessage()}");
				// $this->refresh(); 
			}

			$model->attributes=$_POST['DataPendidikan'];
			if($model->save())
				$this->redirect(array('update','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,'model2'=>$model2,
					));
		
			}

	public function actionUpdateuser($id)
	{
		$model2=new DataPendidikan;
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DataPendidikan']))
		{
			$messageType='warning';
			$message = "There are some errors ";
			$transaction = Yii::app()->db->beginTransaction();
			try{
				$model->attributes=$_POST['DataPendidikan'];
				$messageType = 'info';
				$message = "<strong>Anda berhasil merubah data riwayat pendidikan.</strong> ";

				if($model->save()){
					$transaction->commit();
					$total = count($_POST['tahun1']);
		    		for ($i = 0; $i <= $total; $i++)
		    		{
		    			if(isset($_POST['tahun1'][$i]))
		    			{
		     				$jiakakak = new DataPendidikan;
		     				$jiakakak->nip=$model->nip;
		        			$jiakakak->tahun1 = $_POST['tahun1'][$i];
		        			$jiakakak->tahun2 = $_POST['tahun2'][$i];
		        			$jiakakak->riwayat = $_POST['riwayat'][$i];
		        			$jiakakak->no=$i;
		         			$jiakakak->save();
		    			}	
					}
					Yii::app()->user->setFlash($messageType, $message);
					$this->redirect(array('updateuser','id'=>$model->id));
				}
			}
			catch (Exception $e){
				$transaction->rollBack();
				Yii::app()->user->setFlash('error', "{$e->getMessage()}");
				// $this->refresh(); 
			}

			$model->attributes=$_POST['DataPendidikan'];
			if($model->save())
				$this->redirect(array('updateuser','id'=>$model->id));
		}

		$this->render('updateuser',array(
			'model'=>$model,'model2'=>$model2,
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
		$dataProvider=new CActiveDataProvider('DataPendidikan');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
		*/
		
		$model=new DataPendidikan('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DataPendidikan']))
			$model->attributes=$_GET['DataPendidikan'];

		$this->render('index',array(
			'model'=>$model,
					));
		
			}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		
		$model=new DataPendidikan('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DataPendidikan']))
			$model->attributes=$_GET['DataPendidikan'];

		$this->render('admin',array(
			'model'=>$model,
					));
		
			}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return DataPendidikan the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=DataPendidikan::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param DataPendidikan $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='data-pendidikan-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionExport()
    {
        $model=new DataPendidikan;
		$model->unsetAttributes();  // clear any default values
		if(isset($_POST['DataPendidikan']))
			$model->attributes=$_POST['DataPendidikan'];

		$exportType = $_POST['fileType'];
        $this->widget('ext.heart.export.EHeartExport', array(
            'title'=>'Data Riwayat Pendidikan',
            'dataProvider' => $model->search(),
            'filter'=>$model,
            'grid_mode'=>'export',
            'exportType'=>$exportType,
            'columns' => array(

            	array(
            		'header'=>'NIP',
            		'name'=>'nip',
            		'value'=>'$data->nip',
            	),

            	array(
            		'header'=>'Tahun Ke-1',
            		'name'=>'tahun1',
            		'value'=>'$data->tahun1',
            	),

            	array(
            		'header'=>'Tahun Ke-2',
            		'name'=>'tahun2',
            		'value'=>'$data->tahun2',
            	),

            	array(
            		'header'=>'Riwayat Pendidikan',
            		'name'=>'riwayat',
            		'value'=>'$data->riwayat',
            	),
	            ),
        ));
    }

    public function actionExportuser()
    {
        $model=new DataPendidikan;
		$model->unsetAttributes();  // clear any default values
		if(isset($_POST['DataPendidikan']))
			$model->attributes=$_POST['DataPendidikan'];

		$exportType = $_POST['fileType'];
        $this->widget('ext.heart.export.EHeartExport', array(
            'title'=>'Data Riwayat Pendidikan',
            'dataProvider' => $model->search($model->nip=Yii::app()->user->getId()),
            'filter'=>$model,
            'grid_mode'=>'export',
            'exportType'=>$exportType,
            'columns' => array(

            	array(
            		'header'=>'NIP',
            		'name'=>'nip',
            		'value'=>'$data->nip',
            	),

            	array(
            		'header'=>'Tahun Ke-1',
            		'name'=>'tahun1',
            		'value'=>'$data->tahun1',
            	),

            	array(
            		'header'=>'Tahun Ke-2',
            		'name'=>'tahun2',
            		'value'=>'$data->tahun2',
            	),

            	array(
            		'header'=>'Riwayat Pendidikan',
            		'name'=>'riwayat',
            		'value'=>'$data->riwayat',
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
		
		$model=new DataPendidikan;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DataPendidikan']))
		{
			if (!empty($_FILES)) {
				$tempFile = $_FILES['DataPendidikan']['tmp_name']['fileImport'];
				$fileTypes = array('xls','xlsx'); // File extensions
				$fileParts = pathinfo($_FILES['DataPendidikan']['name']['fileImport']);
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
						//$id=  $sheetData[$baseRow]['A'];
						$riwayat=  $sheetData[$baseRow]['B'];
						$tahun1=  $sheetData[$baseRow]['C'];
						$tahun2=  $sheetData[$baseRow]['D'];
						$nip=  $sheetData[$baseRow]['E'];
						$no=  $sheetData[$baseRow]['F'];

						$model2=new DataPendidikan;
						//$model2->id=  $id;
						$model2->riwayat=  $riwayat;
						$model2->tahun1=  $tahun1;
						$model2->tahun2=  $tahun2;
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
	    $es = new TbEditableSaver('DataPendidikan'); 
			    $es->update();
	}

	public function actions()
	{
    	return array(
        		'toggle' => array(
                	'class'=>'bootstrap.actions.TbToggleAction',
                	'modelName' => 'DataPendidikan',
        		)
    	);
	}

	
}
