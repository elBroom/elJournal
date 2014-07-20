<?php

/**
 * This is the model class for table "{{progress}}".
 *
 * The followings are the available columns in table '{{progress}}':
 * @property integer $id_progress
 * @property integer $id_lesson
 * @property integer $id_user
 * @property integer $estimate
 * @property integer $attendance
 *
 * The followings are the available model relations:
 * @property User $idUser
 * @property Lesson $idLesson
 */
class Progress extends CActiveRecord
{
	public $date;
	public $surname;
	public $firstname;
	public $middlename;
	

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{progress}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_lesson, id_user', 'required'),
			array('id_lesson, id_user, estimate, attendance', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_lesson, estimate, attendance, surname, date, firstname, middlename', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'id_user'),
			'lesson' => array(self::BELONGS_TO, 'Lesson', 'id_lesson'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_progress' => 'Id',
			'id_lesson' => 'Урок',
			'id_user' => 'Студент',
			'estimate' => 'Оценка',
			'attendance' => 'Посещение',
			'date' => 'Дата',
			'surname' => 'Фaмилия',
			'firstname' => 'Имя',
			'middlename' => 'Отчество',
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
	public function search($merge=null)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->with = array('lesson', 'user');

		$criteria->compare('id_progress',$this->id_progress);
		$criteria->compare('id_lesson',$this->id_lesson);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('estimate',$this->estimate, true);
		$criteria->compare('attendance',$this->attendance, true);

		$criteria->compare('lesson.date',$this->date, true);
		$criteria->compare('user.surname',$this->surname, true);
		$criteria->compare('user.firstname',$this->firstname, true);
		$criteria->compare('user.middlename',$this->middlename, true);

		if($merge!==null)
			$criteria->mergeWith($merge);

		$sort = new CSort();
        $sort->attributes = array(
                'estimate',
                'attendance',
                'date' => array(
                    'asc'=>'lesson.date',
                	'desc'=>'lesson.date DESC',
                  ),
                'surname' => array(
                    'asc'=>'user.surname',
                	'desc'=>'user.surname DESC',
                  ),
                'firstname' => array(
                    'asc'=>'user.firstname',
                	'desc'=>'user.firstname DESC',
                  ),
                'middlename' => array(
                    'asc'=>'user.middlename',
                	'desc'=>'user.middlename DESC',
                  ),               
        
        );		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array(
                'pageSize' => 10),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Progress the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
