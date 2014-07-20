<?php if($model->isNewRecord){
	$form=$this->beginWidget('CActiveForm', array(
    'id'=>'discipline-to-teacher-form',
    'enableAjaxValidation'=>false,
)); }?>
<div class="row">
    <?php echo $form->labelEx($model,'id_discipline'); ?>
    <?php echo $form->dropDownList($model,'id_discipline', $disciplins, array('empty' => 'Выбирите дисциплину')); ?>
    <?php echo $form->error($model,'id_discipline'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'id_group'); ?>
    <?php echo $form->dropDownList($model,'id_group', $groups, array('empty' => 'Выбирите группу')); ?>
    <?php echo $form->error($model,'id_group'); ?>
</div>
<?php if($model->isNewRecord){
	$this->endWidget();
}?>