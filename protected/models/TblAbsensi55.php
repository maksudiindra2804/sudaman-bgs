<?php

/**
 * This is the model class for table "tbl_absensi".
 *
 * The followings are the available columns in table 'tbl_absensi':
 * @property string $nip
 * @property string $absen_time
 * @property string $status
 *
 * The followings are the available model relations:
 * @property TblRegistrasi $nip0
 */
class TblAbsensi extends CActiveRecord
{
	//public $verifyCode;
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
			array('nip', 'required'),
			//array('verifyCode','captcha','allowEmpty'=>!extension_loaded('gd')),
			array('nip', 'length', 'max'=>50),
			array('status', 'length', 'max'=>100),
			array('absen_time, pulang_time, total_jam, keterangan', 'safe'),
			/*
			//Example username
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u',
                 'message'=>'Username can contain only alphanumeric 
                             characters and hyphens(-).'),
          	array('username','unique'),
          	*/
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('nip, absen_time, status, id_absen, keterangan, pulang_time, total_jam', 'safe', 'on'=>'search'),
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
			'nip' => 'NIP Pegawai',
			'absen_time' => 'Waktu Absen',
			'status' => 'Status',
			'id_absen'=>'id_absen',
			'keterangan'=>'Keterangan',
			'total_jam'=>'Total Jam Lembur',
			'pulang_time'=>'Jam Kepulangan',
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
		//$criteri2 = new CDbCriteria;
		
		//$rawData = Yii::app()->db->createCommand($criteri2); 

		$criteria=new CDbCriteria;

		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('absen_time',$this->absen_time,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('keterangan',$this->keterangan,true);
		$criteria->compare('pulang_time',$this->pulang_time,true);
		$criteria->compare('total_jam',$this->total_jam,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getData($id)
        {               
               // $count=Yii::app()->db->createCommand('SELECT COUNT(*) FROM meal_expenses_details WHERE meal_expenses_id='.$id)->queryScalar();
                $sql="SELECT nip FROM tbl_absensi WHERE nip='1134040'";                
                return $sql; /*will return a list of arrays.*/
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

	public function getNik(){
      return CHtml::listData(Personal::model()->findAll(),'nip','name');
  	}
}
