<?php
/* @var $this PageController */

$this->breadcrumbs=array(
	'Категория: '.$category->title,
);
?>
<?if($models):?>
<?foreach ($models as $one):?>
<h2><?=CHtml::link($one->title, '/page/view/'.$one->id);?><h2>
<hr>
<?=substr($one->content, 0, 60);?>	
<?endforeach;?>
<?else:?>
<p>В этой категории статей нет.</p>
<?endif;?>
