<?php

/**
 * This is the model class for table "data_pendidikan".
 *
 * The followings are the available columns in table 'data_pendidikan':
 * @property integer $id
 * @property string $riwayat
 * @property string $tahun1
 * @property string $tahun2
 * @property string $nip
 * @property integer $no
 *
 * The followings are the available model relations:
 * @property Personal $nip0
 */
class DataPendidikan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'data_pendidikan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('no', 'numerical', 'integerOnly'=>true),
			array('riwayat', 'length', 'max'=>200),
			array('tahun1, tahun2', 'length', 'max'=>10),
			array('nip', 'length', 'max'=>30),
			/*
			//Example username
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u',
                 'message'=>'Username can contain only alphanumeric 
                             characters and hyphens(-).'),
          	array('username','unique'),
          	*/
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, riwayat, tahun1, tahun2, nip, no', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'riwayat' => 'Riwayat',
			'tahun1' => 'Tahun1',
			'tahun2' => 'Tahun2',
			'nip' => 'Nip',
			'no' => 'No',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('riwayat',$this->riwayat,true);
		$criteria->compare('tahun1',$this->tahun1,true);
		$criteria->compare('tahun2',$this->tahun2,true);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('no',$this->no);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DataPendidikan the static model class
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
}
