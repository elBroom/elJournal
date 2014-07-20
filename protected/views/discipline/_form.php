<?php
/* @var $this DisciplineController */
/* @var $model Discipline */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'discipline-form',
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
    <div class="row">
        <?php echo $form->labelEx($model,'index'); ?>
        <?php echo $form->textField($model,'index',array('size'=>8,'maxlength'=>8)); ?>
        <?php echo $form->error($model,'index'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'id_metBlock'); ?>
        <?php echo $form->dropDownList($model,'id_metBlock', $list, array('empty' => 'Выберите пункт')); ?>
        <?php echo $form->error($model,'id_metBlock'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'exam'); ?>
        <?php echo $form->textField($model,'exam'); ?>
        <?php echo $form->error($model,'exam'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'dif_zachet'); ?>
        <?php echo $form->textField($model,'dif_zachet'); ?>
        <?php echo $form->error($model,'dif_zachet'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'zachet'); ?>
        <?php echo $form->textField($model,'zachet'); ?>
        <?php echo $form->error($model,'zachet'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'sam_rab'); ?>
        <?php echo $form->textField($model,'sam_rab'); ?>
        <?php echo $form->error($model,'sam_rab'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'lection'); ?>
        <?php echo $form->textField($model,'lection'); ?>
        <?php echo $form->error($model,'lection'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'pr_rab'); ?>
        <?php echo $form->textField($model,'pr_rab'); ?>
        <?php echo $form->error($model,'pr_rab'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'cours_rab'); ?>
        <?php echo $form->textField($model,'cours_rab'); ?>
        <?php echo $form->error($model,'cours_rab'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'ucheb_pr'); ?>
        <?php echo $form->textField($model,'ucheb_pr'); ?>
        <?php echo $form->error($model,'ucheb_pr'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'proizv_pr'); ?>
        <?php echo $form->textField($model,'proizv_pr'); ?>
        <?php echo $form->error($model,'proizv_pr'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'sem1'); ?>
        <?php echo $form->textField($model,'sem1'); ?>
        <?php echo $form->error($model,'sem1'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'sem2'); ?>
        <?php echo $form->textField($model,'sem2'); ?>
        <?php echo $form->error($model,'sem2'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'sem3'); ?>
        <?php echo $form->textField($model,'sem3'); ?>
        <?php echo $form->error($model,'sem3'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'sem4'); ?>
        <?php echo $form->textField($model,'sem4'); ?>
        <?php echo $form->error($model,'sem4'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'sem5'); ?>
        <?php echo $form->textField($model,'sem5'); ?>
        <?php echo $form->error($model,'sem5'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'sem6'); ?>
        <?php echo $form->textField($model,'sem6'); ?>
        <?php echo $form->error($model,'sem6'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'sem7'); ?>
        <?php echo $form->textField($model,'sem7'); ?>
        <?php echo $form->error($model,'sem7'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'sem8'); ?>
        <?php echo $form->textField($model,'sem8'); ?>
        <?php echo $form->error($model,'sem8'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'double'); ?>
        <?php echo $form->dropDownList($model,'double', array('1'=>'Не делиться', '2' => 'Делиться'), array('empty' => 'Выберите пункт')); ?>
        <?php echo $form->error($model,'double'); ?>
    </div>

        <?php echo $form->hiddenField($model,'speciality'); ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
        <?php echo $model->isNewRecord ?
        CHtml::button('Отмена', array('onclick' => "window.location='/discipline/addcurriculum'")) :
        CHtml::button('Отмена', array('onclick' => "window.location='/discipline/curriculum'")); ?>
    </div>    

<?php $this->endWidget(); ?>

</div><!-- form -->