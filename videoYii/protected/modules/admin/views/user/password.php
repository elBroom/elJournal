<?php
/* @var $this UserController */
/* @var $model User */

$this->menu=array(
	array('label'=>'Журнал Пользователей', 'url'=>array('index')),
	array('label'=>'Изменить Пользователя', 'url'=>array('update', 'id' => $model->id)),
);
?>

<h1>Изменение пароля пользователя <?php echo $model->id; ?></h1>

<?php 
	echo CHtml::form();
	echo CHtml::textField('password'); 
	echo CHtml::submitButton('Изменить'); 
	echo CHtml::endForm();
?>