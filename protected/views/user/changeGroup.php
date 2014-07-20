<h1><?php echo $this->pageTitle;?></h1>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'group-form','enableAjaxValidation'=>false,
)); ?>

    <p class="note">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title',array('size'=>20,'maxlength'=>20)); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'id_speciality'); ?>
        <?php echo $form->dropDownList($model,'id_speciality', Specialty::getAll(), array('empty'=> 'Выбирети специальность')); ?>
        <?php echo $form->error($model,'id_speciality'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'year_income'); ?>
        <?php echo $form->textField($model,'year_income',array('size'=>4,'maxlength'=>4)); ?>
        <?php echo $form->error($model,'year_income'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
        <?php echo CHtml::button('Отмена', array('onclick' => "window.location='/user/allgroups'")); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->