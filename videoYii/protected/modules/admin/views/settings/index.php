
<h1>Настройки</h1>

<?php if(Yii::app()->user->hasFlash('Settings')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('Settings'); ?>
</div>
<?php endif; ?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'settings-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'defaultStatusComment'); ?>
		<?php echo $form->checkBox($model,'defaultStatusComment'); ?>
		<?php echo $form->error($model,'defaultStatusComment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'defaultStatusUser'); ?>
		<?php echo $form->checkBox($model,'defaultStatusUser'); ?>
		<?php echo $form->error($model,'defaultStatusUser'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
