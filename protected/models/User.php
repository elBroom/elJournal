<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id_user
 * @property string $email
 * @property string $login
 * @property string $password
 * @property string $firstname
 * @property string $surname
 * @property string $middlename
 *
 * The followings are the available model relations:
 * @property Attendance[] $attendances
 * @property Discipline[] $journalDisciplines
 * @property Progress[] $progresses
 * @property Role[] $journalRoles
 * @property Statistic[] $statistics
 */
class User extends CActiveRecord
{
	public $setRole = 3;
	public $curPass;
	public $pass1;
	public $pass2;
	private $_newPass;

	public function getRole(){
		$strRole = '';
		foreach($this->journalRoles as $role)
			$strRole .= $role->name.' ';
		return $strRole;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, login', 'required', 'on'=>'create'),
			array('login', 'loginBusy', 'message'=>'Логин занет, введите другой логин', 'on'=>'create'),
			array('email', 'emailBusy', 'message'=>'Email занет, введите другой email', 'on'=>'create'),
			
			array('curPass, pass1, pass2', 'required', 'on'=>'changePassword'),
			array('pass2', 'compare', 'compareAttribute' => 'pass1', 'on'=>'changePassword', 'message' => 'Пароли не совпадают'),
			array('curPass', 'equalPassword', 'on'=>'changePassword', 'message' => 'Пароль введен не верно'),

			array('email, login, password, firstname, surname, middlename', 'length', 'max'=>128),
			array('email', 'email'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_user, email, login, password, firstname, surname, middlename', 'safe', 'on'=>'search'),
		);
	}

	/*Проверка логина в БД*/
	public function loginBusy($attributes, $params){
		$login = $this->find('LOWER(login)=?', array(strtolower($this->login)));
		if($login === null)
			return true;
		return $this->addError($attributes, $params['message']);
	}

	/*Проверка email в БД*/
	public function emailBusy($attributes, $params){
		$email = $this->find('LOWER(email)=?', array(strtolower($this->email)));
		if($email === null)
			return true;
		return $this->addError($attributes, $params['message']);
	}

	/*Проверка текущего пароля*/
	public function equalPassword($attributes, $params){
		if($this->password === $this->hashPassword($this->curPass))
			return true;
		return $this->addError($attributes, $params['message']);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'disciplines' => array(self::HAS_MANY, 'Discipline', 'id_teacher'),
			'journalDisciplines' => array(self::MANY_MANY, 'Discipline', '{{disciplineToUser}}(id_user, id_discipline)'),
			'progresses' => array(self::HAS_MANY, 'Progress', 'id_user'),
			'journalRoles' => array(self::MANY_MANY, 'Role', '{{roleToUser}}(id_user, id_role)'),
			//'roleStudent' => array(self::HAS_MANY, 'Role', array('id_role'=>'id_user'), 'through'=>'journalRoles'),
			'statistics' => array(self::HAS_MANY, 'Statistic', 'id_user'),
			'students' => array(self::HAS_MANY, 'Student', 'id_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_user' => 'Id',
			'email' => 'Email',
			'login' => 'Логин',
			'password' => 'Пароль',
			'firstname' => 'Имя',
			'surname' => 'Фамилия',
			'middlename' => 'Отчество',
			'role' => 'Роль',
			'setRole' => 'Роль',
			'curPass' => 'Текущий пароль',
			'pass1' => 'Новый пароль',
			'pass2' => 'Повторите пароль',
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

		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('middlename',$this->middlename,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/*Получение всех пользователей с ролью преподавателя*/
	public static function getAllTeacher(){
		$array = array();
		$allUsers = self::model()->with('journalRoles')->findAll();
		foreach ($allUsers as $user) {
			foreach($user->journalRoles as $role){
				if($role->name == 'teacher')
				$array[$user->id_user] = "{$user->surname} {$user->firstname} {$user->middlename}";
			}			
		}
		return $array;
	}

	/*Генерация пароля*/
	public function generateString($length){
		$chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP"; 
		$size=StrLen($chars)-1; 
		$str=null;
		while($length--) 
    		$str.=$chars[rand(0,$size)];

    	//return $str;
		return '12345';
	}

	/*Получение хэша пароля*/
	private function hashPassword($password){
		return md5(md5(Yii::app()->params['salt'].$password));
	}

	/*Отправка письма новому пользователю*/
	protected function mailNewUser(){
		$email = Yii::app()->email;
		$email->from = Yii::app()->params['adminEmail'];
		$email->to = $this->email;
		$email->subject = 'Добро пожаловать';
		$email->view = 'newUser';
		$email->viewVars = array('name' => $this->firstname, 'login'=>$this->login,'password'=>$this->_newPass);
		$email->send();
	}

	/*Отправка письма нового пароля*/
	protected function mailNewPassword(){
		$email = Yii::app()->email;
		$email->from = Yii::app()->params['adminEmail'];
		$email->to = $this->email;
		$email->subject = 'Смена пароля';
		$email->view = 'newPassword';
		$email->viewVars = array('name' => $this->firstname, 'login'=>$this->login,'password'=>$this->_newPass);
		$email->send();
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/*Генерация нового пароля и замена старого*/
	public function newPassword(){
		$this->_newPass = $this->generateString(7);
		$this->password = $this->hashPassword($this->_newPass);
		$this->save();
	}
	protected function beforeSave(){
		if(parent::beforeSave()){
			if($this->isNewRecord){
				$this->_newPass = $this->generateString(7);
				$this->password = $this->hashPassword($this->_newPass);
			}
			if($this->scenario == 'changePassword'){				
				$this->password = $this->hashPassword($this->password);
			}
			return true;
		}
		return false;
	}

	protected function afterSave(){
		parent::afterSave();

		if($this->isNewRecord){
			$role = new RoleToUser;
			$role->id_user = $this->id_user;
			$role->id_role = $this->setRole;
			$role->save();

			//$this->mailNewUser();
		}
		if($this->scenario = 'newPassword'){
			//$this->mailNewUser();
		}
	}
}
