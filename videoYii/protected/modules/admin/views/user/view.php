<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Изменение пароля', 'url'=>array('password', 'id'=>$model->id)),
	array('label'=>'Обновление Пользователя', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удаление Пользователя', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Журнал Пользователей', 'url'=>array('index')),
);
?>

<h1>Просмотр Пользователя #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'password',
		'created',
		'ban',
		'role',
		'email',
	),
)); ?>
