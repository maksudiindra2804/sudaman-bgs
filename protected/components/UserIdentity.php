<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
 class UserIdentity extends CUserIdentity
{
    
    private $_id;
    private $_Lvl;
    private $_username;
    
    public function authenticate()
    {
        $user= Personal::model()->findByAttributes(array('username'=>$this->username));
        if($user===null){
                $user=SpecialAuth::model()->find('username=?', array(
                $this->username));
            if($user==null)
            {
                
            }
            else if ($user->password !== md5($this->password)) {
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
            }
            else
            {
                $this->errorCode=self::ERROR_NONE;
                $this->_id=$user->id_auth;
            }     

        } else if ($user->password !== md5($this->password)) 
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else {
            $this->_id=$user->nip;
            $this->username = $user->username;
            $this->errorCode = self::ERROR_NONE;
       }
        
        return !$this->errorCode;
    }
 
    public function getId()
    {
        return $this->_id;
    }

    public function getLvl()
    {
    return $this->_Lvl;
    }

    
    }