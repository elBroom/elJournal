<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	protected $_id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user = User::model()->find('LOWER(login)=?', array(strtolower($this->username)));
		if($user === null)
			$this->errorCode =self::ERROR_USERNAME_INVALID;
		elseif($user!== null && $user->password !== $this->hashPassword($this->password))
			$this->errorCode =self::ERROR_PASSWORD_INVALID;
		else{
			$this->_id = $user->id_user;
			Statistic::writeStat($this->_id);
			$this->username = $user->firstname;
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}

	private function hashPassword($password){
		return md5(md5(Yii::app()->params['salt'] . $password));
	}

	public function getId(){
		return $this->_id;
	}

}