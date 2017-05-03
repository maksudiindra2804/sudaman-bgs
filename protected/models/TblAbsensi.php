<?php

/**
 * This is the model class for table "tbl_absensi".
 *
 * The followings are the available columns in table 'tbl_absensi':
 * @property integer $id_absen
 * @property string $nip
 * @property string $absen_datang
 * @property string $status
 * @property string $keterangan
 * @property string $absen_pulang
 * @property string $total_jam
 *
 * The followings are the available model relations:
 * @property Personal $nip0
 */
class TblAbsensi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_absensi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nip', 'length', 'max'=>30),
			array('status', 'length', 'max'=>100),
			array('total_jam', 'length', 'max'=>20),
			array('absen_datang, keterangan, absen_pulang', 'safe'),
			/*
			//Example username
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u',
                 'message'=>'Username can contain only alphanumeric 
                             characters and hyphens(-).'),
          	array('username','unique'),
          	*/
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_absen, nip, absen_datang, status, keterangan, absen_pulang, total_jam', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_absen' => 'Id Absen',
			'nip' => 'Nip',
			'absen_datang' => 'Absen Datang',
			'status' => 'Status',
			'keterangan' => 'Keterangan',
			'absen_pulang' => 'Absen Pulang',
			'total_jam' => 'Total Jam',
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

		$criteria->compare('id_absen',$this->id_absen);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('absen_datang',$this->absen_datang,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('keterangan',$this->keterangan,true);
		$criteria->compare('absen_pulang',$this->absen_pulang,true);
		$criteria->compare('total_jam',$this->total_jam,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TblAbsensi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave() 
    {
        $userId=0;
		if(null!=Yii::app()->user->id) $userId=(int)Yii::app()->user->id;
		
		if($this->isNewRecord)
        {           
                        						
        }else{
                        						
        }

        
        return parent::beforeSave();
    }

    public function afterFind()    {
         
        parent::afterFind();
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

    public static function getAbsen()
	{
		return array(
			'Alpha'=>'Alpha',
			'Lembur'=>'Lembur',
			'Ijin'=>'Ijin',
			'Sakit'=>'Sakit',
		);
	}
    public function getNip(){
      return CHtml::listData(Personal::model()->findAll(),'nip','nama_lengkap');
  	}

    public function absenList()
 	{
 		return CHtml::listData(TblAbsensi::model()->findAll(),'id_absen','nip','total_jam','status');
 	}
}
