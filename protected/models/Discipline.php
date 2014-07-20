<?php

/**
 * This is the model class for table "{{discipline}}".
 *
 * The followings are the available columns in table '{{discipline}}':
 * @property integer $id_discipline
 * @property string $title
 *
 * The followings are the available model relations:
 * @property Attendance[] $attendances
 * @property User[] $journalUsers
 * @property Progress[] $progresses
 */
class Discipline extends CActiveRecord
{
	public $speciality;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{discipline}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, id_metBlock, double', 'required'),
			array('id_metBlock, exam, dif_zachet, zachet, sam_rab, lection, pr_rab, cours_rab, ucheb_pr, proizv_pr, double, sem1, sem2, sem3, sem4, sem5, sem6, sem7, sem8', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>128),
			array('index', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_discipline, title', 'safe', 'on'=>'search'),
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
			'metBlock' => array(self::BELONGS_TO, 'MetBlock', 'id_metBlock'),			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_discipline' => 'Id',
			'title' => 'Название',
			'index' => 'Код дисциплины',
			'id_metBlock' => 'Методический блок',
			'exam' => 'Экзамен',
			'dif_zachet' => 'Диференциальный зачет',
			'zachet' => 'Зачет',
			'sam_rab' => 'Самостоятельная работа',
			'lection' => 'Лекция',
			'pr_rab' => 'Практическая работа',
			'cours_rab' => 'Курсовая работа',
			'ucheb_pr' => 'Учебная практика',
			'proizv_pr' => 'Производственная практика',
			'double' => 'Деление на подгруппы',
			'sem1' => '1 семестр',
			'sem2' => '2 семестр',
			'sem3' => '3 семестр',
			'sem4' => '4 семестр',
			'sem5' => '5 семестр',
			'sem6' => '6 семестр',
			'sem7' => '7 семестр',
			'sem8' => '8 семестр',
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
		$criteria=new CDbCriteria;
		$criteria->compare('id_discipline',$this->id_discipline);
		$criteria->compare('title',$this->title,true);

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
	 * @return Discipline the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getAll($criteria = null){
		return CHtml::listData(self::model()->findAll($criteria), 'id_discipline', 'title');
	}
}
