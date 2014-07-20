<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->menu=array(
	array('label'=>'Журнал категорий', 'url'=>array('index'))
);
?>

<h1>Создание категории</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>