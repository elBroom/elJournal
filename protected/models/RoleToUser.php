<?php

/**
 * This is the model class for table "{{roleToUser}}".
 *
 * The followings are the available columns in table '{{roleToUser}}':
 * @property integer $id_role
 * @property integer $id_user
 */
class RoleToUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{roleToUser}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_role, id_user', 'required'),
			array('id_role, id_user', 'numerical', 'integerOnly'=>true),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_role' => 'Роль',
			'id_user' => 'Id пользователя',
		);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function changeRole($idUser, $arrRole){
		$transaction = $this->dbConnection->beginTransaction();
		try {
			$old = $this->findAllByAttributes(array('id_user'=>$idUser));
			foreach ($old as $item) {
				$item->delete();
			}
			foreach ($arrRole as $role) {

				$this->isNewRecord = true;
				$this->id_user = $idUser;
				$this->id_role = $role;
				$this->save();
			}

			$transaction->commit();
			return true;
		} catch (Exception $e) {
			$transaction->rollBack();
			return false;
		}
	}
}
