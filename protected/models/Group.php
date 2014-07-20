<?php

/**
 * This is the model class for table "{{group}}".
 *
 * The followings are the available columns in table '{{group}}':
 * @property integer $id_group
 * @property integer $id_speciality
 * @property string $year_income
 * @property string $title
 *
 * The followings are the available model relations:
 * @property Specialty $idSpeciality
 */
class Group extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{group}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_speciality, year_income, title', 'required'),
			array('id_speciality', 'numerical', 'integerOnly'=>true),
			array('year_income', 'length', 'max'=>4),
			array('title', 'length', 'max'=>20),
			array('id_group, id_speciality, year_income, title', 'safe', 'on'=>'search'),
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
			'idSpecialty' => array(self::BELONGS_TO, 'Specialty', 'id_speciality'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_group' => 'Id Group',
			'id_speciality' => 'Специальность',
			'year_income' => 'Год поступления',
			'title' => 'Группа',
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

		$criteria->compare('id_group',$this->id_group);
		$criteria->compare('id_speciality',$this->id_speciality);
		$criteria->compare('year_income',$this->year_income,true);
		$criteria->compare('title',$this->title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Group the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getAll($criteria = null){
		return CHtml::listData(self::model()->findAll($criteria), 'id_group', 'title');
	}
}
