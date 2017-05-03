<?php

/**
 * This is the model class for table "data_project".
 *
 * The followings are the available columns in table 'data_project':
 * @property integer $id_project
 * @property string $nama_project
 * @property string $tgl_project
 * @property string $rilis_project
 * @property string $status
 * @property string $nip
 * @property integer $no
 *
 * The followings are the available model relations:
 * @property Personal $nip0
 */
class DataProject extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'data_project';
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
			array('nama_project', 'length', 'max'=>200),
			array('status', 'length', 'max'=>500),
			array('nip', 'length', 'max'=>30),
			array('tgl_project, rilis_project', 'safe'),
			/*
			//Example username
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u',
                 'message'=>'Username can contain only alphanumeric 
                             characters and hyphens(-).'),
          	array('username','unique'),
          	*/
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_project, nama_project, tgl_project, rilis_project, status, nip, no', 'safe', 'on'=>'search'),
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
			'id_project' => 'Id Project',
			'nama_project' => 'Nama Project',
			'tgl_project' => 'Tgl Project',
			'rilis_project' => 'Rilis Project',
			'status' => 'Status',
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

		$criteria->compare('id_project',$this->id_project);
		$criteria->compare('nama_project',$this->nama_project,true);
		$criteria->compare('tgl_project',$this->tgl_project,true);
		$criteria->compare('rilis_project',$this->rilis_project,true);
		$criteria->compare('status',$this->status,true);
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
	 * @return DataProject the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave() 
    {
    	$this->tgl_project=date('Y-m-d',strtotime($this->tgl_project));
    	$this->rilis_project=date('Y-m-d',strtotime($this->rilis_project));

    	return true;
    }


    public function afterFind()
    {
    	$this->tgl_project=date('d-m-Y',strtotime($this->tgl_project));
    	$this->rilis_project=date('d-m-Y',strtotime($this->rilis_project));
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
