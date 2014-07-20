<?php
/* @var $this UserController */
/* @var $model User */

$this->menu=array(
	array('label'=>'Журнал Пользователей', 'url'=>array('index')),
	array('label'=>'Просмотр Пользователя', 'url'=>array('view', 'id' => $model->id)),
	array('label'=>'Изменить пароль', 'url'=>array('password', 'id' => $model->id)),
);
?>

<h1>Обновление Пользователя <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>