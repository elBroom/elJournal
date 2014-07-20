<?php
/* @var $this PageController */

$this->breadcrumbs=array(
	'Категория: '. $model->category->title =>array('/page/index', 'id'=>$model->category_id),
	$model->title,
);
?>
<h1><?= $model->title; ?></h1>
<?=date('j.m.y H:i', $model->created);?>
<hr>
<?= $model->content; ?>

