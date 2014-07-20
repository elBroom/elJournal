<h1><?php echo $this->pageTitle;?></h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'type-lesson-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
        <?php echo CHtml::button('Отмена', array('onclick' => "window.location='/discipline/listtypelesson'")); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->