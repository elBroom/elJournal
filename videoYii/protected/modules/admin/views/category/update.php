<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->menu=array(
	array('label'=>'Журнал категорий', 'url'=>array('index')),
	array('label'=>'Создать категорию', 'url'=>array('create')),
);
?>

<h1>Изменение категории <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>