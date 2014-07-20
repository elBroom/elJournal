<?php

/**
 * This is the model class for table "{{lesson}}".
 *
 * The followings are the available columns in table '{{lesson}}':
 * @property integer $id_lesson
 * @property integer $id_discipline
 * @property string $date
 *
 * The followings are the available model relations:
 * @property Discipline $idDiscipline
 * @property Progress[] $progresses
 */
class Lesson extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{lesson}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_discipline, date, type', 'required'),
			array('id_discipline, type', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_lesson, id_discipline, date, type', 'safe', 'on'=>'search'),
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
			'discipline' => array(self::BELONGS_TO, 'DisciplineToTeacher', 'id_discipline'),
			'progresses' => array(self::HAS_MANY, 'Progress', 'id_lesson'),
			'counStudents' => array(self::STAT, 'Progress', 'id_lesson',
				'condition' => 't.attendance=0',),
			'typeLesson' => array(self::BELONGS_TO, 'TypeLesson', 'type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_lesson' => 'Id Lesson',
			'id_discipline' => 'Дисциплина',
			'date' => 'Дата',
			'counStudents' => 'Присутствовали',
			'type' => 'Тип урока',
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

		$criteria->compare('id_lesson',$this->id_lesson);
		$criteria->compare('id_discipline',$this->id_discipline);
		$criteria->compare('type',$this->type);
		$criteria->compare('date',$this->date,true);


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
	 * @return Lesson the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	protected function afterSave(){
		parent::afterSave();
		$users = DisciplineToUser::model()->findAllByAttributes(array('id_discipline'=>$this->id_discipline));
		
		if($this->isNewRecord){
			foreach ($users as $user) {	
				$model = new Progress;					
				$model->id_user = $user->id_user;
				$model->id_lesson = $this->id_lesson;
				$model->save();
				
			}
		}
	}
}
