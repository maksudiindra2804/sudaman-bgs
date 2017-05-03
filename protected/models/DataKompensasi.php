<?php

/**
 * This is the model class for table "data_kompensasi".
 *
 * The followings are the available columns in table 'data_kompensasi':
 * @property integer $id_kompensasi
 * @property string $nip
 * @property string $nama_lengkap
 * @property integer $id_jabatan
 * @property integer $id_talent
 * @property integer $id_karier
 * @property integer $id_absen
 * @property string $jenis_reward
 * @property string $keterangan_reward
 * @property string $jumlah
 * @property string $total
 * @property string $tgl_data
 *
 * The followings are the available model relations:
 * @property Personal $nip0
 * @property TblJabatan $idJabatan
 * @property DataTalent $idTalent
 * @property DataKarier $idKarier
 * @property TblAbsensi $idAbsen
 */
class DataKompensasi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'data_kompensasi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_jabatan, id_talent, id_karier, id_absen', 'numerical', 'integerOnly'=>true),
			array('nip, id_jabatan, id_absen, id_talent, jumlah','required'),
			array('nip', 'length', 'max'=>30),
			array('nama_lengkap', 'length', 'max'=>150),
			array('jenis_reward', 'length', 'max'=>100),
			array('jumlah', 'length', 'max'=>50),
			array('keterangan_reward, tgl_data', 'safe'),
			/*
			//Example username
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u',
                 'message'=>'Username can contain only alphanumeric 
                             characters and hyphens(-).'),
          	array('username','unique'),
          	*/
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_kompensasi, nip, nama_lengkap, id_jabatan, id_talent, id_karier, id_absen, jenis_reward, keterangan_reward, jumlah, tgl_data', 'safe', 'on'=>'search'),
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
			'idTalent' => array(self::BELONGS_TO, 'DataTalent', 'id_talent'),
			'idKarier' => array(self::BELONGS_TO, 'DataKarier', 'id_karier'),
			'idAbsen' => array(self::BELONGS_TO, 'TblAbsensi', 'id_absen'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_kompensasi' => 'Id Kompensasi',
			'nip' => 'Nip',
			'nama_lengkap' => 'Nama Lengkap',
			'id_jabatan' => 'Id Jabatan',
			'id_talent' => 'Id Talent',
			'id_karier' => 'Id Karier',
			'id_absen' => 'Id Absen',
			'jenis_reward' => 'Jenis Reward',
			'keterangan_reward' => 'Keterangan Reward',
			'jumlah' => 'Jumlah',
			'tgl_data' => 'Tgl Data',
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

		$criteria->compare('id_kompensasi',$this->id_kompensasi);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('nama_lengkap',$this->nama_lengkap,true);
		$criteria->compare('id_jabatan',$this->id_jabatan);
		$criteria->compare('id_talent',$this->id_talent);
		$criteria->compare('id_karier',$this->id_karier);
		$criteria->compare('id_absen',$this->id_absen);
		$criteria->compare('jenis_reward',$this->jenis_reward,true);
		$criteria->compare('keterangan_reward',$this->keterangan_reward,true);
		$criteria->compare('jumlah',$this->jumlah,true);
		$criteria->compare('tgl_data',$this->tgl_data,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DataKompensasi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave() 
    {
    	$this->tgl_data=date('Y-m-d H:i:s', strtotime($this->tgl_data));
    	return TRUE;
    }

    public function afterFind()
    {
    	$this->tgl_data=date('d-m-Y H:i:s', strtotime($this->tgl_data));
    	//$this->jenis_reward = explode(', ', trim($this->jenis_reward));
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

	public function talentList()
 	{
 		return CHtml::listData(DataTalent::model()->findAll(),'id_talent','status','keterangan');
 	}

    public function absenList()
 	{
 		return CHtml::listData(TblAbsensi::model()->findAll(),'id_absen','nip','total_jam','status');
 	}
}
