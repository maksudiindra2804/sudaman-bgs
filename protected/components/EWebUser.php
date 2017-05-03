<?php

	class EWebUser extends CWebUser{
	private $_model;
	
	private function loadModel()
	{
		if($this->_model==null)
		{
			$this->_model=Personal::model()->findByPk($this->id);
				if($this->_model==null)
				{
					$this->_model=SpecialAuth::model()->findByPk($this->id);
				}		
		}
		return $this->_model;
	}
		
	public function getLevel()
	{
		$user=$this->loadModel();
		if($user)
			return $user->id_role;
		return 100;
		}
	}
?>