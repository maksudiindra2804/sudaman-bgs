<?php

/**
 * This is the model class for table "data_karier".
 *
 * The followings are the available columns in table 'data_karier':
 * @property integer $id_karier
 * @property integer $id_talent
 * @property string $nip
 * @property integer $id_jabatan
 * @property string $nama_lengkap
 * @property string $tgl_data
 * @property string $tgl_pelatihan
 * @property string $status
 * @property string $keterangan
 * @property string $deskripsi
 *
 * The followings are the available model relations:
 * @property DataTalent $idTalent
 * @property Personal $nip0
 * @property TblJabatan $idJabatan
 */
class DataKarier extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'data_karier';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_jabatan, id_mapping', 'numerical', 'integerOnly'=>true),
			array('nip', 'length', 'max'=>30),
			array('nama_lengkap', 'length', 'max'=>150),
			array('status', 'length', 'max'=>50),
			array('tgl_data, tgl_pelatihan, keterangan, deskripsi', 'safe'),
			array('id_karier, nip, id_jabatan, nama_lengkap, tgl_data, tgl_pelatihan, status, keterangan, deskripsi, id_mapping', 'safe', 'on'=>'search'),
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
			'idMapping'=>array(self::BELONGS_TO, 'MappingKarier','id_mapping'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_karier' => 'Id Karier',
			'nip' => 'Nip',
			'id_jabatan' => 'Id Jabatan',
			'nama_lengkap' => 'Nama Lengkap',
			'tgl_data' => 'Tgl Data',
			'tgl_pelatihan' => 'Tgl Pelatihan',
			'status' => 'Status',
			'keterangan' => 'Keterangan',
			'deskripsi' => 'Deskripsi',
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

		$criteria->compare('id_karier',$this->id_karier);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('id_jabatan',$this->id_jabatan);
		$criteria->compare('nama_lengkap',$this->nama_lengkap,true);
		$criteria->compare('tgl_data',$this->tgl_data,true);
		$criteria->compare('tgl_pelatihan',$this->tgl_pelatihan,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('keterangan',$this->keterangan,true);
		$criteria->compare('deskripsi',$this->deskripsi,true);
		$criteria->compare('id_mapping',$this->id_mapping,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DataKarier the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave() 
    {
    	$this->tgl_pelatihan=date('Y-m-d H:i:s', strtotime($this->tgl_pelatihan));
    	$this->tgl_data=date('Y-m-d H:i:s', strtotime($this->tgl_data));

    	return TRUE;
    }


    public function afterFind()
    {     
        $this->tgl_pelatihan=date('d-m-Y H:i:s', strtotime($this->tgl_pelatihan));
    	$this->tgl_data=date('d-m-Y H:i:s', strtotime($this->tgl_data));
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

 	public function mappingList()
 	{
 		return CHtml::listData(MappingKarier::model()->findAll(),'id_mapping','mapping','child_mapping');
 	}

 	public function talentList()
 	{
 		return CHtml::listData(DataTalent::model()->findAll(),'id_talent','status','keterangan');
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

	public static function getStatus()
	{
		return array(
			'Lulus'=>'Lulus',
			'Tidak Lulus'=>'Tidak Lulus',
			'Pending'=>'Pending',
		);
	}
}
