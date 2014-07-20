<?php 
	class WebUser extends CWebUser{
		private $_model = null;

		public function getRole(){
			if($user = $this->getModel()){
				foreach($user->journalRoles as $role)
					$arrRole[] = $role->name;
				
				return $arrRole;
			}
		}

		private function getModel(){
			if(!$this->isGuest && $this->_model === null){
				$this->_model = User::model()->findByPk($this->id, array('select' => 'id_user'));
			}
			return $this->_model;
		}
	}
?>