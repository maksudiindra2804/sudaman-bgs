<?php

class PersonalController extends Controller
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
				'actions'=>array('index','view','registrasi','lookupprovinsi','captcha','viewuser','exportdata1','updateuser','addpendidikan','addproject','changepassword','addpendidikan2','addproject2','gettalent'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('ridha'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','export','import','editable','toggle','calendar', 'calendarEvents','lookupprovinsi','view','create','update','viewuseradm','addpendidikanadm','addproject','gettalent'),
				'users'=>array('adminbgs'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
		
	/**
	 * Manages all models.
	 */
	public function actionGettalent()
	{
		
		$model = new DataTalent('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DataTalent']))
			$model->attributes=$_GET['DataTalent'];

		$this->render('viewuser',array(
			'model'=>$model,
					));
		
			}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		//$code = new EncrptionUrl;

      	//$id = $code->decode($id);
		//$model = $this->loadModel($id);
		
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
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionViewuser($id)
	{
		$code = new EncrptionUrl;
		$id = $code->decode($id);
		$model =  $this->loadModel($id);
		$model = Personal::model()->findByPk($id);  
		$haha=new CDbCriteria;
		$criteria=new CDbCriteria;
        $criteria->compare('nip',$id);
        $this->render('viewuser', 
        	array('model'=>$model,
        		));
    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionViewuseradm($id)
	{
		//$code = new EncrptionUrl;

      	//$id = $code->decode($id);
		//$model = $this->loadModel($id);
		
		if(isset($_GET['asModal'])){
			$this->renderPartial('viewuseradm',array(
				'model'=>$this->loadModel($id),
			));
		}
		else{
						
			$this->render('viewuseradm',array(
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
				
		$model=new Personal;
		$code = new EncrptionUrl;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Personal']))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try{
				$messageType='warning';
				$message = "There are some errors ";
				$model->attributes=$_POST['Personal'];
				$model->password=md5($_POST['Personal']['password']);
				$model->id_role=3;
				$decrypt = $code->encode($model->nip);
				$model->durasi_kerja=$model->durasi_kerja1." - ".$model->durasi_kerja2; 

				$sss=CUploadedFile::getInstance($model,'photo');
				$model->photo=$model->nip.'.'.$sss->extensionName;
				if($model->save()){
					$messageType = 'info';
					$message = "<strong>Berhasil menambah data.</strong> ";

					$path=Yii::app()->basePath.'/../photo/'.$model->photo;
					$sss->saveAs($path);

					$transaction->commit();
					Yii::app()->user->setFlash($messageType, $message);
					$this->redirect(array('create','id'=>$decrypt));
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionRegistrasi()
	{
				
		$model=new Personal;
		$code = new EncrptionUrl;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Personal']))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try{
				$messageType='warning';
				$message = "There are some errors ";
				$model->attributes=$_POST['Personal'];
				$model->password=md5($_POST['Personal']['password']);
				$model->id_role=3;
				$decrypt = $code->encode($model->nip);
				$model->photo='default.png';
				$model->durasi_kerja=$model->durasi_kerja1." - ".$model->durasi_kerja2; 

				$sss=CUploadedFile::getInstance($model,'photo');
				$model->photo=$model->nip.'.'.$sss->extensionName;
				if($model->save()){
					$messageType = 'info';
					$message = "<strong>Berhasil melakukan Registrasi, silahkan Login.</strong> ";

					$path=Yii::app()->basePath.'/../photo/'.$model->photo;
					$sss->saveAs($path);

					$transaction->commit();
					Yii::app()->user->setFlash($messageType, $message);
					$this->redirect(array('registrasi','id'=>$decrypt));
				}				
			}
			catch (Exception $e){
				$transaction->rollBack();
				Yii::app()->user->setFlash('error', "{$e->getMessage()}");
				//$this->refresh();
			}
			
		}

		$this->render('registrasi',array(
			'model'=>$model,
					));
		
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		
		//$code = new EncrptionUrl;
      	//$id = $code->decode($id);
      	//$decrypt = $code->encode(Yii::app()->user->getId());
		$model=$this->loadModel($id);
			
		if(isset($_POST['Personal'])){
			$model->attributes=$_POST['Personal'];
			$model->durasi_kerja=$model->durasi_kerja1." - ".$model->durasi_kerja2; 
		
			$foto=Personal::model()->findByPk($id);
			$model->photo=$foto->photo;
			
				
				if(strlen(trim(CUploadedFile::getInstance($model,'photo'))) > 0){
					$sss=CUploadedFile::getInstance($model,'photo');
					$model->photo=$model->nip.'.'.$sss->extensionName;
				}

			if($model->save())
			{	
				$messageType = 'info';
				$message = "<strong>Data telah dirubah</strong>";
				Yii::app()->user->setFlash($messageType, $message);
				

				if(strlen(trim(CUploadedFile::getInstance($model,'photo'))) > 0)
				{			
					$path=Yii::app()->basePath . '/../photo/'.$model->photo;
					$sss->saveAs($path);
				}				$this->redirect(array('admin','id'=>$model->nip));
				
			}
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
		
		$code = new EncrptionUrl;

      	$id = $code->decode($id);
      	$decrypt = $code->encode(Yii::app()->user->getId());
		$model=$this->loadModel($id);
			
		if(isset($_POST['Personal'])){
			$model->attributes=$_POST['Personal'];
			$model->durasi_kerja=$model->durasi_kerja1." - ".$model->durasi_kerja2; 
		
			$foto=Personal::model()->findByPk($id);
			$model->photo=$foto->photo;
			
				
				if(strlen(trim(CUploadedFile::getInstance($model,'photo'))) > 0){
					$sss=CUploadedFile::getInstance($model,'photo');
					$model->photo=$model->nip.'.'.$sss->extensionName;
				}

			if($model->save())
			{	
				$messageType = 'success';
				$message = "Data telah dirubah";
				Yii::app()->user->setFlash($messageType, $message);
				

				if(strlen(trim(CUploadedFile::getInstance($model,'photo'))) > 0)
				{			
					$path=Yii::app()->basePath . '/../photo/'.$model->photo;
					$sss->saveAs($path);
				}				$this->redirect(array('viewuser','id'=>$decrypt));
				
			}
		}
		$this->render('updateuser',array(
			'model'=>$model,
		));
	}

	public function actionAddpendidikan($id)
	{
		
		$code = new EncrptionUrl;
		$model2 = new DataPendidikan;

      	$id = $code->decode($id);
      	$decrypt = $code->encode(Yii::app()->user->getId());
		$model=$this->loadModel($id);
			
		if(isset($_POST['Personal'])){
			$model->attributes=$_POST['Personal'];
			$foto=Personal::model()->findByPk($id);
			$model->photo=$foto->photo;
			
				
				if(strlen(trim(CUploadedFile::getInstance($model,'photo'))) > 0){
					$sss=CUploadedFile::getInstance($model,'photo');
					$model->photo=$model->nip.'.'.$sss->extensionName;
				}
			if($model->save())
			{	
				$messageType = 'info';
				$message = "<strong>Anda berhasil menambah data.</strong>";
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
				if(strlen(trim(CUploadedFile::getInstance($model,'photo'))) > 0)
				{			
					$path=Yii::app()->basePath . '/../photo/'.$model->photo;
					$sss->saveAs($path);
				}	
				$this->redirect(array('addpendidikan','id'=>$decrypt));
				
			}
		}
		$this->render('addpendidikan',array(
			'model'=>$model,'model2'=>$model2
		));
	}

	public function actionAddproject($id)
	{
		
		$code = new EncrptionUrl;
		$model2 = new DataProject;

      	$id = $code->decode($id);
      	$decrypt = $code->encode(Yii::app()->user->getId());
		$model=$this->loadModel($id);
			
		if(isset($_POST['Personal'])){
			$model->attributes=$_POST['Personal'];
			$foto=Personal::model()->findByPk($id);
			$model->photo=$foto->photo;
			
				
				if(strlen(trim(CUploadedFile::getInstance($model,'photo'))) > 0){
					$sss=CUploadedFile::getInstance($model,'photo');
					$model->photo=$model->nip.'.'.$sss->extensionName;
				}

			if($model->save())
			{	
				$messageType = 'info';
				$message = "<strong>Anda berhasil menambah data.</strong>";
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
				Yii::app()->user->setFlash($messageType, $message);
				if(strlen(trim(CUploadedFile::getInstance($model,'photo'))) > 0)
				{			
					$path=Yii::app()->basePath . '/../photo/'.$model->photo;
					$sss->saveAs($path);
				}	
				$this->redirect(array('addproject','id'=>$decrypt));
				
			}
		}
		$this->render('addproject',array(
			'model'=>$model,'model2'=>$model2
		));
	}

	public function actionAddpendidikanadm($id)
	{
		
		$code = new EncrptionUrl;
		$model2 = new DataPendidikan;

      	$id = $code->decode($id);
      	$decrypt = $code->encode(Yii::app()->user->getId());
		$model=$this->loadModel($id);
			
		if(isset($_POST['Personal'])){
			$model->attributes=$_POST['Personal'];
			$foto=Personal::model()->findByPk($id);
			$model->photo=$foto->photo;
			
				
				if(strlen(trim(CUploadedFile::getInstance($model,'photo'))) > 0){
					$sss=CUploadedFile::getInstance($model,'photo');
					$model->photo=$model->nip.'.'.$sss->extensionName;
				}
			if($model->save())
			{	
				$messageType = 'success';
				$message = "Data telah dirubah";
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
				if(strlen(trim(CUploadedFile::getInstance($model,'photo'))) > 0)
				{			
					$path=Yii::app()->basePath . '/../photo/'.$model->photo;
					$sss->saveAs($path);
				}	
				$this->redirect(array('addpendidikanadm','id'=>$decrypt));
				
			}
		}
		$this->render('addpendidikanadm',array(
			'model'=>$model,'model2'=>$model2
		));
	}

	public function actionAddprojectadm($id)
	{
		
		$code = new EncrptionUrl;
		$model2 = new DataProject;

      	$id = $code->decode($id);
      	$decrypt = $code->encode(Yii::app()->user->getId());
		$model=$this->loadModel($id);
			
		if(isset($_POST['Personal'])){
			$model->attributes=$_POST['Personal'];
			$foto=Personal::model()->findByPk($id);
			$model->photo=$foto->photo;
			
				
				if(strlen(trim(CUploadedFile::getInstance($model,'photo'))) > 0){
					$sss=CUploadedFile::getInstance($model,'photo');
					$model->photo=$model->nip.'.'.$sss->extensionName;
				}

			if($model->save())
			{	
				$messageType = 'success';
				$message = "Data telah dirubah";
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
				Yii::app()->user->setFlash($messageType, $message);
				if(strlen(trim(CUploadedFile::getInstance($model,'photo'))) > 0)
				{			
					$path=Yii::app()->basePath . '/../photo/'.$model->photo;
					$sss->saveAs($path);
				}	
				$this->redirect(array('addprojectadm','id'=>$decrypt));
				
			}
		}
		$this->render('addprojectadm',array(
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
		$dataProvider=new CActiveDataProvider('Personal');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
		*/
		
		$model=new Personal('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Personal']))
			$model->attributes=$_GET['Personal'];

		$this->render('index',array(
			'model'=>$model,
					));
		
			}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		
		$model=new Personal('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Personal']))
			$model->attributes=$_GET['Personal'];

		$this->render('admin',array(
			'model'=>$model,
					));
		
			}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Personal the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Personal::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Personal $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='personal-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionExportdata1()
    {
        $model=new Personal;
		$model->unsetAttributes();  // clear any default values
		if(isset($_POST['Personal']))
			$model->attributes=$_POST['Personal'];

		$exportType = $_POST['fileType'];
        $this->widget('ext.heart.export.EHeartExport', array(
            'title'=>'Biodata Diri',
            'dataProvider' => $model->search1($model->nip=Yii::app()->user->getId()),
            'filter'=>$model,
            'grid_mode'=>'export',
            'exportType'=>$exportType,
            'columns' => array(
	                
	                array(
	                	'header'=>'NIP Anda',
	                	'name'=>'nip',
	                	'value'=>'$data->nip',
	                ),

	                array(
	                	'header'=>'Nama Lengkap',
	                	'name'=>'nama_lengkap',
	                	'value'=>'$data->nama_lengkap',
	                ),

	                array(
	                	'header'=>'Agama',
	                	'name'=>'agama',
	                	'value'=>'$data->agama',
	                ),

	                array(
	                	'header'=>'Tempat, Tanggal Lahir',
	                	'name'=>'tgl_lahir',
	                	'value'=>'($data->tempat_lahir.\', \'.$data->tgl_lahir)',
	                ),

	                array(
	                	'header'=>'Jenis Kelamin',
	                	'name'=>'jenkel',
	                	'value'=>'$data->jenkel',
	                ),

	                array(
	                	'header'=>'Usia',
	                	'name'=>'usia',
	                	'value'=>'$data->usia',
	                ),

	                array(
	                	'header'=>'Golongan Darah',
	                	'name'=>'goldar',
	                	'value'=>'$data->goldar',
	                ),

	                array(
	                	'header'=>'Alamat Lengkap',
	                	'name'=>'alamat',
	                	'value'=>'($data->alamat.\'. Kode Pos : \'.$data->kode_pos.\'. \'.$data->provinsi->nama_provinsi.\'. \'.$data->idKotkab->nama_kotkab)',
	                ),

	                array(
	                	'header'=>'No. Telepon',
	                	'name'=>'no_telp',
	                	'value'=>'$data->no_telp',
	                ),

	                array(
	                	'header'=>'Kewarganegaraan',
	                	'name'=>'kewarganegaraan',
	                	'value'=>'$data->kewarganegaraan',
	                ),

	                array(
	                	'header'=>'Status Kawin',
	                	'name'=>'status_perkawinan',
	                	'value'=>'$data->status_perkawinan',
	                ),

	                array(
	                	'header'=>'Username',
	                	'name'=>'username',
	                	'value'=>'$data->username',
	                ),

	                array(
	                	'header'=>'E-mail',
	                	'name'=>'email',
	                	'value'=>'$data->email',
	                ),
					array(
            			'header'=>'Jenis Jenjang',
            			'name'=>'jenis_jenjang',
            			'value'=>'$data->jenis_jenjang',
            		),

            		array(
            			'header'=>'Nama Jenjang Sekolahan',
            			'name'=>'nama_jenjang',
            			'value'=>'$data->nama_jenjang',
            		),

            		array(
            			'header'=>'Peguruan Tinggi',
            			'name'=>'id_pt',
            			'value'=>'($data->idPt->nama_pt)',
            		),

            		array(
            			'header'=>'Strata',
            			'name'=>'strata_akhir',
            			'value'=>'$data->strata_akhir',
            		),

            		array(
            			'header'=>'Jurusan/Fakultas/Program Studi',
            			'name'=>'jurusan',
            			'value'=>'$data->jurusan',
            		),

            		array(
            			'header'=>'Jabatan',
            			'name'=>'id_jabatan',
            			'value'=>'$data->idJabatan->nama_jabatan',
            		),

            		array(
            			'header'=>'Status Kepegawaian',
            			'name'=>'status_pegawai',
            			'value'=>'$data->status_pegawai',
            		),

            		array(
            			'header'=>'Masa Kerja',
            			'name'=>'durasi_kerja',
            			'value'=>'$data->durasi_kerja',
            		),
					//'id_jabatan',
					//'jenis_jenjang',
					//'nama_jenjang',
					//'id_pt',
					//'strata_akhir',
					//'tgl_data',
					//'id_role',
					//'status_pegawai',
					//'durasi_kerja',
					//'photo',
	            ),
        ));
    }
    
	public function actionExport()
    {
        $model=new Personal;
		$model->unsetAttributes();  // clear any default values
		if(isset($_POST['Personal']))
			$model->attributes=$_POST['Personal'];

		$exportType = $_POST['fileType'];
        $this->widget('ext.heart.export.EHeartExport', array(
            'title'=>'Daftar Pegawai',
            'dataProvider' => $model->search(),
            'filter'=>$model,
            'grid_mode'=>'export',
            'exportType'=>$exportType,
            'columns' => array(
	                
					'nip',
					'nama_lengkap',
					'agama',
					'tgl_lahir',
					'tempat_lahir',
					'jenkel',
					'goldar',
					'alamat',
					'kode_pos',
					'provinsi_id',
					'id_kotkab',
					'no_telp',
					'kewarganegaraan',
					'status_perkawinan',
					'id_jabatan',
					'jenis_jenjang',
					'nama_jenjang',
					'id_pt',
					'strata_akhir',
					'username',
					'password',
					'email',
					'tgl_data',
					'id_role',
					'status_pegawai',
					'durasi_kerja',
					'photo',
	            ),
        ));
    }

    /**
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionImport()
	{
		
		$model=new Personal;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Personal']))
		{
			if (!empty($_FILES)) {
				$tempFile = $_FILES['Personal']['tmp_name']['fileImport'];
				$fileTypes = array('xls','xlsx'); // File extensions
				$fileParts = pathinfo($_FILES['Personal']['name']['fileImport']);
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
						$nip=  $sheetData[$baseRow]['A'];
						$nama_lengkap=  $sheetData[$baseRow]['B'];
						$agama=  $sheetData[$baseRow]['C'];
						$tgl_lahir=  $sheetData[$baseRow]['D'];
						$tempat_lahir=  $sheetData[$baseRow]['E'];
						$jenkel=  $sheetData[$baseRow]['F'];
						$goldar=  $sheetData[$baseRow]['G'];
						$alamat=  $sheetData[$baseRow]['H'];
						$kode_pos=  $sheetData[$baseRow]['I'];
						$provinsi_id=  $sheetData[$baseRow]['J'];
						$id_kotkab=  $sheetData[$baseRow]['K'];
						$no_telp=  $sheetData[$baseRow]['L'];
						$kewarganegaraan=  $sheetData[$baseRow]['M'];
						$status_perkawinan=  $sheetData[$baseRow]['N'];
						$id_jabatan=  $sheetData[$baseRow]['O'];
						$jenis_jenjang=  $sheetData[$baseRow]['P'];
						$nama_jenjang=  $sheetData[$baseRow]['Q'];
						$id_pt=  $sheetData[$baseRow]['R'];
						$strata_akhir=  $sheetData[$baseRow]['S'];
						$username=  $sheetData[$baseRow]['T'];
						$password=  $sheetData[$baseRow]['U'];
						$email=  $sheetData[$baseRow]['V'];
						$tgl_data=  $sheetData[$baseRow]['W'];
						$id_role=  $sheetData[$baseRow]['X'];
						$status_pegawai=  $sheetData[$baseRow]['Y'];
						$durasi_kerja=  $sheetData[$baseRow]['Z'];
						$photo=  $sheetData[$baseRow]['AA'];

						$model2=new Personal;
						$model2->nip=  $nip;
						$model2->nama_lengkap=  $nama_lengkap;
						$model2->agama=  $agama;
						$model2->tgl_lahir=  $tgl_lahir;
						$model2->tempat_lahir=  $tempat_lahir;
						$model2->jenkel=  $jenkel;
						$model2->goldar=  $goldar;
						$model2->alamat=  $alamat;
						$model2->kode_pos=  $kode_pos;
						$model2->provinsi_id=  $provinsi_id;
						$model2->id_kotkab=  $id_kotkab;
						$model2->no_telp=  $no_telp;
						$model2->kewarganegaraan=  $kewarganegaraan;
						$model2->status_perkawinan=  $status_perkawinan;
						$model2->id_jabatan=  $id_jabatan;
						$model2->jenis_jenjang=  $jenis_jenjang;
						$model2->nama_jenjang=  $nama_jenjang;
						$model2->id_pt=  $id_pt;
						$model2->strata_akhir=  $strata_akhir;
						$model2->username=  $username;
						$model2->password=  $password;
						$model2->email=  $email;
						$model2->tgl_data=  $tgl_data;
						$model2->id_role=  $id_role;
						$model2->status_pegawai=  $status_pegawai;
						$model2->durasi_kerja=  $durasi_kerja;
						$model2->photo=  $photo;

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
	    $es = new TbEditableSaver('Personal'); 
			    $es->update();
	}

	public function actions()
	{
    	return array(
        		'toggle' => array(
                	'class'=>'bootstrap.actions.TbToggleAction',
                	'modelName' => 'Personal',
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

	
	public function actionCalendar()
	{
		$model=new Personal('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Personal']))
			$model->attributes=$_GET['Personal'];
		$this->render('calendar',array(
			'model'=>$model,
		));	
	}

	public function actionCalendarEvents()
	{	 	
	 	$items = array();
	 	$model=Personal::model()->findAll();	
		foreach ($model as $value) {
			$items[]=array(
				'id'=>$value->nip,
								
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
		$id_provinsi = $_POST['Personal']['provinsi_id'];
		$list = TblKotkab::model()->findAllBySql('SELECT * FROM tbl_kotkab WHERE provinsi_id=:id_provinsi', array(':id_provinsi'=>$id_provinsi));
		$list = CHtml::listData($list,'id_kotkab','nama_kotkab');
		echo CHtml::tag('option',array('value'=>''),'Pilihan Kota/Kabupaten', true);
		foreach($list as $value=>$nama){
			echo CHtml::tag('option',array('value'=>$value),CHtml::encode($nama), true);
		}
	}

	public function actionChangepassword()
 	{      
    $model = new Personal;

    $model = Personal::model()->findByPk(Yii::app()->user->id);
    $model->setScenario('changePwd');
 
     if(isset($_POST['Personal'])){
 
        $model->attributes = $_POST['Personal'];
        $valid = $model->validate();
 
        if($valid){
 
          $model->password = md5($model->passwordBaru);
 
          if($model->save())
          	//$messageType = 'info';
		//$//message = "Anda berhasil merubah password";
			//Yii::app()->user->setFlash($messageType, $message);
             $this->redirect(array('changepassword','message'=>'successfully changed password'));
          else
             $this->redirect(array('changepassword','message'=>'password not changed'));
            }
        }
 
    $this->render('changepassword',array('model'=>$model)); 
 }

 	public function actionAddpendidikan2($id)
	{
		
		$code = new EncrptionUrl;
		$model3 = new DataPendidikan;

      	$id = $code->decode($id);
      	$decrypt = $code->encode(Yii::app()->user->getId());
		$model=$this->loadModel($id);
			
		if(isset($_POST['Personal'])){
			$model->attributes=$_POST['Personal'];
			$foto=Personal::model()->findByPk($id);
			$model->photo=$foto->photo;
			
				
				if(strlen(trim(CUploadedFile::getInstance($model,'photo'))) > 0){
					$sss=CUploadedFile::getInstance($model,'photo');
					$model->photo=$model->nip.'.'.$sss->extensionName;
				}
			if($model->save())
			{	
				$messageType = 'info';
				$message = "<strong>Anda berhasil menambah data.</strong>";
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
				if(strlen(trim(CUploadedFile::getInstance($model,'photo'))) > 0)
				{			
					$path=Yii::app()->basePath . '/../photo/'.$model->photo;
					$sss->saveAs($path);
				}	
				$this->redirect(array('addpendidikan','id'=>$decrypt));
				
			}
		}
		$this->render('addpendidikan',array(
			'model'=>$model,'model3'=>$model3
		));
	}

	public function actionAddproject2($id)
	{
		
		$code = new EncrptionUrl;
		$model3 = new DataProject;

      	$id = $code->decode($id);
      	$decrypt = $code->encode(Yii::app()->user->getId());
		$model=$this->loadModel($id);
			
		if(isset($_POST['Personal'])){
			$model->attributes=$_POST['Personal'];
			$foto=Personal::model()->findByPk($id);
			$model->photo=$foto->photo;
			
				
				if(strlen(trim(CUploadedFile::getInstance($model,'photo'))) > 0){
					$sss=CUploadedFile::getInstance($model,'photo');
					$model->photo=$model->nip.'.'.$sss->extensionName;
				}

			if($model->save())
			{	
				$messageType = 'info';
				$message = "<strong>Anda berhasil menambah data.</strong>";
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
				Yii::app()->user->setFlash($messageType, $message);
				if(strlen(trim(CUploadedFile::getInstance($model,'photo'))) > 0)
				{			
					$path=Yii::app()->basePath . '/../photo/'.$model->photo;
					$sss->saveAs($path);
				}	
				$this->redirect(array('addproject','id'=>$decrypt));
				
			}
		}
		$this->render('addproject',array(
			'model'=>$model,'model3'=>$model3
		));
	}
}
