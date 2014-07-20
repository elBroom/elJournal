<?php
	class PhpAuthManager extends CPhpAuthManager{
		public function init(){
			if($this->authFile === null){
				$this->authFile = Yii::getPathOfAlias('application.config.auth').'.php';
			}
			 parent::init();

			 if(!Yii::app()->user->isGuest){

			 	foreach(Yii::app()->user->role as $role){
			 		$this->assign($role, Yii::app()->user->id);
			 	}			 	
			 }
		}
	}
?>