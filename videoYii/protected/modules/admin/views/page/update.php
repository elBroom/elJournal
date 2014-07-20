<?php
/* @var $this PageController */
/* @var $model Page */

$this->menu=array(
	array('label'=>'Журнал Страниц', 'url'=>array('index')),
	array('label'=>'Создание Страницы', 'url'=>array('create')),
);
?>

<h1>Обновление Страницы <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>