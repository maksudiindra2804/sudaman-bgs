<?php

/**
 * This is the model class for table "data_trainner".
 *
 * The followings are the available columns in table 'data_trainner':
 * @property string $kode_trainner
 * @property string $nama_trainner
 * @property string $tgl_data
 *
 * The followings are the available model relations:
 * @property DataTalent[] $dataTalents
 */
class DataTrainner extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'data_trainner';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kode_trainner', 'required'),
			array('kode_trainner', 'length', 'max'=>10),
			array('nama_trainner', 'length', 'max'=>100),
			array('tgl_data', 'safe'),
			/*
			//Example username
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u',
                 'message'=>'Username can contain only alphanumeric 
                             characters and hyphens(-).'),
          	array('username','unique'),
          	*/
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('kode_trainner, nama_trainner, tgl_data', 'safe', 'on'=>'search'),
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
			'dataTalents' => array(self::HAS_MANY, 'DataTalent', 'kode_trainner'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'kode_trainner' => 'Kode Trainner',
			'nama_trainner' => 'Nama Trainner',
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

		$criteria->compare('kode_trainner',$this->kode_trainner,true);
		$criteria->compare('nama_trainner',$this->nama_trainner,true);
		$criteria->compare('tgl_data',$this->tgl_data,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DataTrainner the static model class
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

    public function afterFind()    {
         
        $this->tgl_data=date('d-m-Y H:i:s', strtotime($this->tgl_data));

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

 	public function trainnerList(){
      return CHtml::listData(DataTrainner::model()->findAll(),'kode_trainner','nama_trainner');
 	}
}
