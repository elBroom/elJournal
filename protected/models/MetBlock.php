<?php

/**
 * This is the model class for table "{{metBlock}}".
 *
 * The followings are the available columns in table '{{metBlock}}':
 * @property integer $id_metBlock
 * @property string $index
 * @property string $title
 * @property integer $id_speciality
 */
class MetBlock extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{metBlock}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, id_speciality', 'required'),
			array('id_speciality, id_parent', 'numerical', 'integerOnly'=>true),
			array('index', 'length', 'max'=>8),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_metBlock, index, title, id_speciality', 'safe', 'on'=>'search'),
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
			'discipline' => array(self::BELONGS_TO, 'Discipline', 'id_discipline'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_metBlock' => 'ID',
			'index' => 'Код',
			'title' => 'Название',
			'id_speciality' => 'Специальность',
			'id_parent' => 'Методический блок',
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

		$criteria->compare('id_metBlock',$this->id_metBlock);
		$criteria->compare('index',$this->index,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('id_speciality',$this->id_speciality);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MetBlock the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

}
