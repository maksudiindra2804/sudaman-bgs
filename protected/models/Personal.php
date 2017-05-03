<?php

/**
 * This is the model class for table "personal".
 *
 * The followings are the available columns in table 'personal':
 * @property string $nip
 * @property string $nama_lengkap
 * @property string $agama
 * @property string $tgl_lahir
 * @property string $tempat_lahir
 * @property string $jenkel
 * @property string $goldar
 * @property string $alamat
 * @property string $kode_pos
 * @property string $provinsi_id
 * @property integer $id_kotkab
 * @property string $no_telp
 * @property string $kewarganegaraan
 * @property string $status_perkawinan
 * @property integer $id_jabatan
 * @property string $jenis_jenjang
 * @property string $nama_jenjang
 * @property integer $id_pt
 * @property string $strata_akhir
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $tgl_data
 * @property integer $id_role
 * @property string $status_pegawai
 * @property string $durasi_kerja
 * @property string $photo
 *
 * The followings are the available model relations:
 * @property TblProvinsi $provinsi
 * @property TblKotkab $idKotkab
 * @property TblJabatan $idJabatan
 * @property UserRole $idRole
 * @property TblPt $idPt
 * @property TblAbsensi[] $tblAbsensis
 */
class Personal extends CActiveRecord
{
	public $verifyCode;
	public $durasi_kerja1;
	public $durasi_kerja2;
	public $passwordLama;
	public $passwordBaru;
	public $passwordUlangi;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'personal';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('verifyCode','captcha','allowEmpty'=>!extension_loaded('gd')),
			//array('nip, nama_lengkap, username, password, email', 'required'),
			array('id_kotkab, id_jabatan, id_pt, id_role', 'numerical', 'integerOnly'=>true),
			array('nip, agama, username', 'length', 'max'=>30),
			array('nama_lengkap, jenis_jenjang, nama_jenjang, password, status_pegawai, photo, jurusan', 'length', 'max'=>100),
			array('tempat_lahir, provinsi_id, status_perkawinan, strata_akhir', 'length', 'max'=>50),
			array('jenkel, kode_pos, no_telp', 'length', 'max'=>20),
			array('durasi_kerja, durasi_kerja1, durasi_kerja2','length','max'=>50),
			array('goldar, usia', 'length', 'max'=>3),
			array('kewarganegaraan', 'length', 'max'=>80),
			array('email', 'length', 'max'=>120),
			array('tgl_lahir, alamat, tgl_data', 'safe'),

			//validations
			array('username, password, nip','filter','filter'=>'strtolower'),
			array('username, password, nip','unique'),
			array('email','email','checkMX'=>true),

			//validations reset password
			array('passwordLama, passwordBaru, passwordUlangi','required','on'=>'changePwd'),
			array('passwordLama','findPasswords','on'=>'changePwd'),
			array('passwordUlangi','compare','compareAttribute'=>'passwordBaru','on'=>'changePwd'),

			/*
			//Example username
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u',
                 'message'=>'Username can contain only alphanumeric 
                             characters and hyphens(-).'),
          	array('username','unique'),
          	*/
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('nip, nama_lengkap, agama, tgl_lahir, tempat_lahir, jenkel, goldar, alamat, kode_pos, provinsi_id, id_kotkab, no_telp, kewarganegaraan, status_perkawinan, id_jabatan, jenis_jenjang, nama_jenjang, id_pt, strata_akhir, username, password, email, tgl_data, id_role, status_pegawai, durasi_kerja, photo, usia, jurusan', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'provinsi' => array(self::BELONGS_TO, 'TblProvinsi', 'provinsi_id'),
			'idKotkab' => array(self::BELONGS_TO, 'TblKotkab', 'id_kotkab'),
			'idJabatan' => array(self::BELONGS_TO, 'TblJabatan', 'id_jabatan'),
			'idRole' => array(self::BELONGS_TO, 'UserRole', 'id_role'),
			'idPt' => array(self::BELONGS_TO, 'TblPt', 'id_pt'),
			'tblAbsensis' => array(self::HAS_MANY, 'TblAbsensi', 'nip'),
			'nip0'=>array(self::HAS_MANY,'DataPendidikan','nip'),
			'nip1' => array(self::BELONGS_TO, 'Personal', 'nip'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'nip' => 'Nip',
			'nama_lengkap' => 'Nama Lengkap',
			'agama' => 'Agama',
			'tgl_lahir' => '',
			'tempat_lahir' => 'Tempat Lahir',
			'jenkel' => 'Jenkel',
			'goldar' => 'Goldar',
			'alamat' => 'Alamat',
			'kode_pos' => 'Kode Pos',
			'provinsi_id' => 'Provinsi',
			'id_kotkab' => 'Id Kotkab',
			'no_telp' => 'No Telp',
			'kewarganegaraan' => 'Kewarganegaraan',
			'status_perkawinan' => 'Status Perkawinan',
			'id_jabatan' => 'Id Jabatan',
			'jenis_jenjang' => 'Jenis Jenjang',
			'nama_jenjang' => 'Nama Jenjang',
			'id_pt' => 'Id Pt',
			'strata_akhir' => 'Strata Akhir',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'tgl_data' => 'Create At',
			'id_role' => 'Id Role',
			'status_pegawai' => 'Status Pegawai',
			'durasi_kerja' => 'Durasi Kerja',
			'photo' => 'Photo',
			'usia'=>'Usia',
			'jurusan'=>'Jurusan',
			'durasi_kerja1'=>'',
			'durasi_kerja2'=>'',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('nama_lengkap',$this->nama_lengkap,true);
		$criteria->compare('agama',$this->agama,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('tempat_lahir',$this->tempat_lahir,true);
		$criteria->compare('jenkel',$this->jenkel,true);
		$criteria->compare('goldar',$this->goldar,true);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('provinsi_id',$this->provinsi_id,true);
		$criteria->compare('id_kotkab',$this->id_kotkab);
		$criteria->compare('no_telp',$this->no_telp,true);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan,true);
		$criteria->compare('status_perkawinan',$this->status_perkawinan,true);
		$criteria->compare('id_jabatan',$this->id_jabatan);
		$criteria->compare('jenis_jenjang',$this->jenis_jenjang,true);
		$criteria->compare('nama_jenjang',$this->nama_jenjang,true);
		$criteria->compare('id_pt',$this->id_pt);
		$criteria->compare('strata_akhir',$this->strata_akhir,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('tgl_data',$this->tgl_data,true);
		$criteria->compare('id_role',$this->id_role);
		$criteria->compare('status_pegawai',$this->status_pegawai,true);
		$criteria->compare('durasi_kerja',$this->durasi_kerja,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('usia',$this->usia,true);
		$criteria->compare('jurusan',$this->jurusan,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function search3()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		
		$criteria->compare('id_jabatan',$this->id_jabatan);
		$criteria->compare('status_pegawai',$this->status_pegawai,true);
		$criteria->compare('durasi_kerja',$this->durasi_kerja,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function search2()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('jenis_jenjang',$this->jenis_jenjang,true);
		$criteria->compare('nama_jenjang',$this->nama_jenjang,true);
		$criteria->compare('id_pt',$this->id_pt);
		$criteria->compare('strata_akhir',$this->strata_akhir,true);
		$criteria->compare('jurusan',$this->jurusan,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function search1()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('nama_lengkap',$this->nama_lengkap,true);
		$criteria->compare('agama',$this->agama,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('tempat_lahir',$this->tempat_lahir,true);
		$criteria->compare('jenkel',$this->jenkel,true);
		$criteria->compare('goldar',$this->goldar,true);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('provinsi_id',$this->provinsi_id,true);
		$criteria->compare('id_kotkab',$this->id_kotkab);
		$criteria->compare('no_telp',$this->no_telp,true);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan,true);
		$criteria->compare('status_perkawinan',$this->status_perkawinan,true);
		$criteria->compare('id_jabatan',$this->id_jabatan);
		$criteria->compare('jenis_jenjang',$this->jenis_jenjang,true);
		$criteria->compare('nama_jenjang',$this->nama_jenjang,true);
		$criteria->compare('id_pt',$this->id_pt);
		$criteria->compare('strata_akhir',$this->strata_akhir,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('tgl_data',$this->tgl_data,true);
		$criteria->compare('id_role',$this->id_role);
		$criteria->compare('status_pegawai',$this->status_pegawai,true);
		$criteria->compare('durasi_kerja',$this->durasi_kerja,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('usia',$this->usia,true);
		$criteria->compare('jurusan',$this->jurusan,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Personal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave() 
    {
    	$this->tgl_data=date('Y-m-d H:i:s', strtotime($this->tgl_data));
    	$this->tgl_lahir=date('Y-m-d', strtotime($this->tgl_lahir));

    	$this->durasi_kerja1=date('Y-m-d', strtotime($this->durasi_kerja1));
		$this->durasi_kerja2=date('Y-m-d', strtotime($this->durasi_kerja2));

    	return true;
    }

    public function afterFind()    
    {
    	$this->tgl_data=date('d-m-Y H:i:s', strtotime($this->tgl_data));
    	$this->tgl_lahir=date('d-m-Y', strtotime($this->tgl_lahir));

    	$gabung = explode(" ", trim($this->durasi_kerja));
		$this->durasi_kerja1=@$gabung[0]." ".@$gabung[1]." ".@$gabung[2];
		$this->durasi_kerja2=@$gabung[4]." ".@$gabung[5]." ".@$gabung[6];

    	return true;
    }

    public function getProvinsi(){
      return CHtml::listData(TblProvinsi::model()->findAll(),'provinsi_id','nama_provinsi');
  	}
	
	public function getKotkab(){
      return CHtml::listData(TblKotkab::model()->findAll(),'id_kotkab','nama_kotkab');
 	}

 	public function getPt(){
      return CHtml::listData(TblPt::model()->findAll(),'id_pt','nama_pt');
 	}

 	public function getJabatan()
 	{
 		return CHtml::listData(TblJabatan::model()->findAll(),'id_jabatan','nama_jabatan');
 	}

 	public function kotkabList()
	{
		$models = TblKotkab::model()->findAll(array('condition' => 'provinsi_id ='."'".$this->provinsi_id."'", 'order'=> 'id_kotkab'));
		foreach ($models as $model)
			$_items[$model->id_kotkab] = $model->nama_kotkab;
		return $_items;
	}

    public function nipList(){
      return CHtml::listData(Personal::model()->findAll(),'nip','nama_lengkap');
 	}

	public static function listStrata(){
	return array(
		'D1'=>'D1',
		'D2'=>'D2',
		'D3'=>'D3',
		'D4'=>'D4',
		'S1'=>'S1',
		'S2'=>'S2',
		'S3'=>'S3',
		);
	}

	public static function listJenjang(){
	return array(
		'SMA'=>'SMA',
		'SMK'=>'SMK',
		'Perguruan Tinggi'=>'Perguruan Tinggi',
		);
	}
	
	public static function getStatus()
	{
		return array(
			'Pegawai Tetap'=>'Pegawai Tetap',
			'Kontrak'=>'Kontrak',
			'Outsourcing'=>'Out Sourcing',
			'Magang'=>'Magang',
			'Freelance'=>'Freelance',
		);
	}	
	
	public function defaultScope()
    {
    	/*
    	//Example Scope
    	return array(
	        'condition'=>"deleted IS NULL ",
            'order'=>'create_time DESC',
            'limit'=>5,
        );
        */
        $scope=array();

        
        return $scope;
    }

    public function findPasswords($passwordLama)
    {
    	$model = Personal::model()->findByPk(Yii::app()->user->id);
    	if ($model->password != md5($this->passwordLama))
    		$this->addError($passwordLama, 'Password lama tidak benar');
    }
}
