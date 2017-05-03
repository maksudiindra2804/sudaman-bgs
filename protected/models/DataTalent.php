<?php

/**
 * This is the model class for table "data_talent".
 *
 * The followings are the available columns in table 'data_talent':
 * @property integer $id_talent
 * @property integer $id_jabatan
 * @property string $nip
 * @property string $nama_lengkap
 * @property integer $id_pelatihan
 *
 * The followings are the available model relations:
 * @property Personal $nip0
 * @property TblJabatan $idJabatan
 * @property DataPelatihan $idPelatihan
 */
class DataTalent extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'data_talent';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nip, tgl_mulai','required'),
			array('id_jabatan, id_pelatihan', 'numerical', 'integerOnly'=>true),
			array('nip', 'length', 'max'=>30),
			array('status','length','max'=>100),
			array('nama_lengkap, tempat', 'length', 'max'=>100),
			array('id_kategori, durasi, kode_trainner', 'length', 'max'=>10),
			array('tgl_data, tgl_mulai, tgl_selesai, keterangan','safe'),
			/*
			//Example username
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u',
                 'message'=>'Username can contain only alphanumeric 
                             characters and hyphens(-).'),
          	array('username','unique'),
          	*/
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_talent, id_jabatan, nip, nama_lengkap, id_pelatihan, status, id_kategori, tgl_mulai, tgl_selesai, tgl_data, tempat, durasi, keterangan', 'safe', 'on'=>'search'),
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
			'nip0' => array(self::BELONGS_TO, 'Personal', 'nip'),
			'idJabatan' => array(self::BELONGS_TO, 'TblJabatan', 'id_jabatan'),
			'idPelatihan' => array(self::BELONGS_TO, 'DataPelatihan', 'id_pelatihan'),
			'idKategori' => array(self::BELONGS_TO, 'DataKategori', 'id_kategori'),
			'kodeTrainner' => array(self::BELONGS_TO, 'DataTrainner', 'kode_trainner'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_talent' => 'ID Talenta',
			'id_jabatan' => 'ID Jabatan',
			'nip' => 'NIP',
			'nama_lengkap' => 'Nama Lengkap',
			'id_pelatihan' => 'ID Pelatihan',
			'status'=>'Status',
			'id_kategori'=>'Kategori Pelatihan',
			'tgl_data'=>'Tanggal Data',
			'tgl_mulai'=>'Tanggal Penyelenggaraan',
			'tgl_selesai'=>'Tanggal Selesai',
			'tempat'=>'Tempat Penyelenggaraan',
			'durasi'=>'Durasi Pelatihan',
			'keterangan'=>'Deskripsi Pelatihan',
			'kode_trainner'=>'Kode Trainner',

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

		$criteria->compare('id_talent',$this->id_talent);
		$criteria->compare('id_jabatan',$this->id_jabatan);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('nama_lengkap',$this->nama_lengkap,true);
		$criteria->compare('id_pelatihan',$this->id_pelatihan);
		$criteria->compare('status',$this->status);
		$criteria->compare('id_kategori',$this->id_kategori,true);
		$criteria->compare('tgl_mulai',$this->tgl_mulai,true);
		$criteria->compare('tgl_data',$this->tgl_data,true);
		$criteria->compare('tgl_selesai',$this->tgl_selesai,true);
		$criteria->compare('tempat',$this->tempat,true);
		$criteria->compare('durasi',$this->durasi,true);
		$criteria->compare('keterangan',$this->keterangan,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function search2()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_talent',$this->id_talent);
		$criteria->compare('id_jabatan',$this->id_jabatan);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('nama_lengkap',$this->nama_lengkap,true);
		$criteria->compare('id_pelatihan',$this->id_pelatihan);
		$criteria->compare('status',$this->status);
		$criteria->compare('id_kategori',$this->id_kategori,true);
		$criteria->compare('tgl_mulai',$this->tgl_mulai,true);
		$criteria->compare('tgl_data',$this->tgl_data,true);
		$criteria->compare('tgl_selesai',$this->tgl_selesai,true);
		$criteria->compare('tempat',$this->tempat,true);
		$criteria->compare('durasi',$this->durasi,true);
		$criteria->compare('keterangan',$this->keterangan,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DataTalent the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave() 
    {
    	$this->tgl_data = date('Y-m-d H:i:s', strtotime($this->tgl_data));
    	$this->tgl_mulai = date('Y-m-d H:i:s', strtotime($this->tgl_mulai));
    	$this->tgl_selesai = date('Y-m-d H:i:s', strtotime($this->tgl_selesai));
		return TRUE;
    }

    public function afterFind()
    {     
    	$this->tgl_data = date('Y-m-d H:i:s', strtotime($this->tgl_data));
    	$this->tgl_mulai = date('Y-m-d H:i:s', strtotime($this->tgl_mulai));
    	$this->tgl_selesai = date('Y-m-d H:i:s', strtotime($this->tgl_selesai));

    	return TRUE;
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

    public function nipList(){
      return CHtml::listData(Personal::model()->findAll(),'nip','nama_lengkap');
 	}

 	public function trainnerList(){
      return CHtml::listData(DataTrainner::model()->findAll(),'kode_trainner','nama_trainner');
 	}

 	public function getJabatan()
 	{
 		return CHtml::listData(TblJabatan::model()->findAll(),'id_jabatan','nama_jabatan');
 	}

 	public function lookuppegawai()
	{
		$models = Personal::model()->findAll(array('condition' => 'id_jabatan ='."'".$this->id_jabatan."'", 'order'=> 'nip'));
		foreach ($models as $model)
			$_items[$model->nip][$model->nama_lengkap] = $model->nama_lengkap;
		return $_items;
	}

	public function pelatihanList(){
      return CHtml::listData(DataPelatihan::model()->findAll(),'id_pelatihan','jenis','status');
 	}

	public function getKategori(){
      return CHtml::listData(DataKategori::model()->findAll(),'id_kategori','kategori');
 	}

 	public function talentList()
 	{
 		return CHtml::listData(DataTalent::model()->findAll(),'id_talent','status','keterangan');
 	}
 	
 	public static function getStatus()
	{
		return array(
			'Pending'=>'Pending',
			'Sedang Berjalan'=>'Sedang Berjalan',
			'Lulus'=>'Lulus',
			'Tidak Lulus'=>'Tidak Lulus',
		);
	}
}
