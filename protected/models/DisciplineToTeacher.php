<?php

/**
 * This is the model class for table "{{disciplineToTeacher}}".
 *
 * The followings are the available columns in table '{{disciplineToTeacher}}':
 * @property integer $id_notice
 * @property integer $id_discipline
 * @property integer $id_group
 * @property integer $id_teacher
 *
 * The followings are the available model relations:
 * @property User $idTeacher
 * @property Discipline $idDiscipline
 * @property Group $idGroup
 * @property User[] $journalUsers
 * @property Lesson[] $lessons
 */
class DisciplineToTeacher extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{disciplineToTeacher}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_discipline, id_group, id_teacher, sem', 'required'),
			array('id_discipline, id_group, id_teacher, sem', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_notice, id_discipline, id_group, id_teacher, sem', 'safe', 'on'=>'search'),
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
			'teacher' => array(self::BELONGS_TO, 'User', 'id_teacher'),
			'discipline' => array(self::BELONGS_TO, 'Discipline', 'id_discipline'),
			'group' => array(self::BELONGS_TO, 'Group', 'id_group'),
			'journalUsers' => array(self::MANY_MANY, 'User', '{{disciplineToUser}}(id_discipline, id_user)'),
			'lessons' => array(self::HAS_MANY, 'Lesson', 'id_discipline'),
			'counStudents' => array(self::STAT, 'DisciplineToUser', 'id_discipline'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_notice' => 'ID записи',
			'id_discipline' => 'Дисциплина',
			'id_group' => 'Группа',
			'id_teacher' => 'Преподаватель',
			'sem' => 'Семестр',
			'counStudents' => 'Количество студентов',
			'specialty' => 'специальность',
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

		$criteria->compare('id_notice',$this->id_notice);
		$criteria->compare('id_discipline',$this->id_discipline);
		$criteria->compare('id_group',$this->id_group);
		$criteria->compare('id_teacher',$this->id_teacher);
		$criteria->compare('sem',$this->sem);

		if($merge!==null)
			$criteria->mergeWith($merge);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DisciplineToTeacher the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function allForTeacher(){
		return CHtml::listData($this->findAllByAttributes(array('id_teacher'=>Yii::app()->user->id)), 'id_notice', 'discipline.title');
	}

	public static function getAllSem(){
		$arr = array();
		for ($i=1; $i < 9; $i++) { 
			$arr[$i] = $i;
		}
		return $arr;
	}
}
