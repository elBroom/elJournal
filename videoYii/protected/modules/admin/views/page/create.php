<?php
/* @var $this PageController */
/* @var $model Page */

$this->menu=array(
	array('label'=>'Журнал Страниц', 'url'=>array('index')),
);
?>

<h1>Создание страницы</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>