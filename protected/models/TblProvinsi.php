<?php

/**
 * This is the model class for table "tbl_provinsi".
 *
 * The followings are the available columns in table 'tbl_provinsi':
 * @property string $provinsi_id
 * @property string $nama_provinsi
 * @property string $create_at
 *
 * The followings are the available model relations:
 * @property Personal[] $personals
 * @property TblKotkab[] $tblKotkabs
 */
class TblProvinsi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_provinsi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('provinsi_id', 'required'),
			array('provinsi_id', 'length', 'max'=>50),
			array('nama_provinsi', 'length', 'max'=>255),
			array('create_at', 'safe'),
			/*
			//Example username
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u',
                 'message'=>'Username can contain only alphanumeric 
                             characters and hyphens(-).'),
          	array('username','unique'),
          	*/
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('provinsi_id, nama_provinsi, create_at', 'safe', 'on'=>'search'),
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
			'personals' => array(self::HAS_MANY, 'Personal', 'provinsi_id'),
			'tblKotkabs' => array(self::HAS_MANY, 'TblKotkab', 'provinsi_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'provinsi_id' => 'Provinsi',
			'nama_provinsi' => 'Nama Provinsi',
			'create_at' => 'Create At',
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

		$criteria->compare('provinsi_id',$this->provinsi_id,true);
		$criteria->compare('nama_provinsi',$this->nama_provinsi,true);
		$criteria->compare('create_at',$this->create_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TblProvinsi the static model class
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

        
        	// NOT SURE RUN PLEASE HELP ME -> 
        	//$from=DateTime::createFromFormat('d/m/Y',$this->create_at);
        	//$this->create_at=$from->format('Y-m-d');
        	
        return parent::beforeSave();
    }

    public function beforeDelete () {
		$userId=0;
		if(null!=Yii::app()->user->id) $userId=(int)Yii::app()->user->id;
                                
        return false;
    }

    public function afterFind()    {
         
        	// NOT SURE RUN PLEASE HELP ME -> 
        	//$from=DateTime::createFromFormat('Y-m-d',$this->create_at);
        	//$this->create_at=$from->format('d/m/Y');
        	
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

    public function getProvinsi(){
      return CHtml::listData(TblProvinsi::model()->findAll(),'provinsi_id','nama_provinsi');
  	}
	
	public function getKotkab(){
      return CHtml::listData(TblKotkab::model()->findAll(),'id_kotkab','nama_kotkab');
 	}
}
