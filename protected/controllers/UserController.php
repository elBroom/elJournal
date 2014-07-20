<?php 
	class UserController extends Controller{
		/**
		 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
		 * using two-column layout. See 'protected/views/layouts/column2.php'.
		 */
		public $layout='//layouts/column2';
		public $defaultAction = 'statistics';

		/**
		 * @return array action filters
		 */
		public function filters()
		{
			return array(
				'accessControl', // контроль доступа к действиям
				'postOnly + delete, deletegroup', // Разрешаем удалять только если данные пришли через POST
			);
		}

		/**
		 * Specifies the access control rules.
		 * This method is used by the 'accessControl' filter.
		 * @return array access control rules
		 */
		public function accessRules()
		{
			return array(
				array('allow',  // allow all users to perform 'index' and 'view' actions
					'actions'=>array('changepassword', 'updateme', 'statistics'),
					'users'=>array('@'),
				),
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
					'actions'=>array('updateRole', 'delete', 'create', 'allusers', 'deletegroup', 'allgroups', 'changegroup'),
					'roles'=>array('admin'),
				),
				array('deny',  // deny all users
					'users'=>array('*'),
				),
			);
		}	

		

		/*Вывод статистики*/
		public function actionStatistics(){
			$criteria = new CDbCriteria();

			$criteria->limit = 4;
			$criteria->order = 'date DESC';
			$criteria->condition = 'id_user=' . Yii::app()->user->id;
			$model = Statistic::model()->findAll($criteria);
			$this->render('statistics', array('model'=>$model));
		}

		/*Редактирование личного профиля*/
		public function actionUpdateme(){
			$user = User::model()->findByPk(Yii::app()->user->id);
			if(isset($_POST['User'])){
				$user->attributes = $_POST['User'];
				if($user->save())
					$this->redirect('/');
			}

			$this->render('updateMe', array('model'=>$user));
		}

		/*Список всех пользователей*/
		public function actionAllusers(){

			$users=new User('search');
			$users->unsetAttributes();  // clear any default values
			if(isset($_GET['User']))
				$users->attributes=$_GET['User'];

			$this->render('allusers', array('users'=>$users));
		}

		/*Создание пользователя*/
		public function actionCreate(){
			$model = new User;
			$model->scenario = 'create';
			$this->performAjaxValidation($model);
			$student = new Student;
			$valid = true;
			
			if(isset($_POST['User'])){
				$model->attributes=$_POST['User'];
				$model->setRole = $_POST['User']['setRole'];
				$valid = $valid && $model->validate();					
			}

			if(isset($_POST['Student'])){
				$student->attributes = $_POST['Student'];
				if($_POST['User']['setRole'] == 3)
					$valid = $valid && $student->validate();
			}

			if(isset($_POST['User']) && $valid){
				$model->save();
				$student->id_user = $model->id_user;
				if(isset($_POST['Student']) && $_POST['User']['setRole'] == 3)
					$student->save();
				$this->redirect(array('allusers'));
			}							

			$this->render('create',array('model'=>$model, 'student'=>$student));
		}

		/*Удаление пользователя*/
		public function actionDelete($id){
			if(Yii::app()->request->isPostRequest){
				User::model()->findByPk($id)->delete();
		
				if(!isset($_GET['ajax']))
					$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('allusers'));
			} else
				throw new CHttpException(400, 'Запрос не корректен. Пожалуйста не повторяйте этот запрос сново.');
		}

		/*Изменение роли пользователея*/
		public function actionUpdateRole($id){
			$student = Student::model()->findByAttributes(array('id_user' => $id));
			if(!$student) $student = false;
			$valid = true;

			if(isset($_POST['Student'])){
				$student->attributes = $_POST['Student'];
				if($_POST['Role'][3] == 1)
					$valid = $valid && $student->save();
			}

			if(isset($_POST['Role']) && !empty($_POST['Role']) && $valid){
				foreach ($_POST['Role'] as $key => $role)
					$arrRol[] = $key;

				if(RoleToUser::model()->changeRole($id, $arrRol))
					$this->redirect(array('allusers'));
			}
			$roles = Role::model()->findAll();
			$user = User::model()->findByPk($id);
			$this->render('update', array('user'=>$user, 'roles' => $roles, 'student' => $student));
		}

		/*Изменение пароля пользователя*/
		public function actionChangepassword(){
			$user = User::model()->findByPk(Yii::app()->user->id);
			$user->scenario = 'changePassword';
			if(isset($_POST['User'])){
				$user->attributes = $_POST['User'];
				if($user->validate()){
					$user->password = $user->pass1;
					if($user->save(false))
						$this->redirect(array('/'));
				}
			}

			$this->render('changePassword', array('model' => $user));
		}

		/*Список всех групп*/
		public function actionAllgroups(){

			$groups=new Group('search');
			$groups->unsetAttributes();  // clear any default values
			if(isset($_GET['Group']))
				$groups->attributes=$_GET['Group'];

			$this->render('allgroups', array('groups'=>$groups));
		}

		public function actionChangegroup($id = null){
			if($id == null){
				$model = new Group;
				$this->pageTitle = 'Создать группу';
			}
			else{
				$model = Group::model()->findByPk($id);
				$this->pageTitle = 'Изменить группу';
			}

			if(isset($_POST['Group'])){
	            $model->attributes=$_POST['Group'];
	            if($model->save())
	                $this->redirect('allgroups');
	        }

			$this->render('changeGroup', array('model' => $model));
		}

		/*Удаление группы*/
		public function actionDeletegroup($id){
        	if(Yii::app()->request->isPostRequest){
				Group::model()->findByPk($id)->delete();
		
				if(!isset($_GET['ajax']))
					$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('allgroups'));
			} else
				throw new CHttpException(400, 'Запрос не корректен. Пожалуйста не повторяйте этот запрос сново.');
    	}

		/**
		 * Performs the AJAX validation.
		 * @param User $model the model to be validated
		 */
		protected function performAjaxValidation($model)
		{
			if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
			{
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}
		}
	}
 ?>