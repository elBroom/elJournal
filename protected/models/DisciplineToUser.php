<?php

/**
 * This is the model class for table "{{disciplineToUser}}".
 *
 * The followings are the available columns in table '{{disciplineToUser}}':
 * @property integer $id_discipline
 * @property integer $id_user
 */
class DisciplineToUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{disciplineToUser}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_discipline, id_user', 'required'),
			array('id_discipline, id_user', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_discipline, id_user', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'id_teacher', 'through'=>'discipline'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_discipline' => 'Дисциплина',
			'id_user' => 'Id студента',
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

		$criteria->compare('id_discipline',$this->id_discipline);
		$criteria->compare('id_user',$this->id_user);

		if($merge!==null)
			$criteria->mergeWith($merge);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function allForStudent(){
		$model = $this->findAllByAttributes(array('id_user'=>Yii::app()->user->id));
		foreach($model as $row){
			$arrResult[$row->id_discipline] = $row->discipline->discipline->title;
		}
		return $arrResult;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DisciplineToUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
