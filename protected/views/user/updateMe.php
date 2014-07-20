<?php $this->pageTitle = 'Изменение профиля'?>
<h1><?php echo $this->pageTitle;?></h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'user-updateme-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Поля с <span class="required">*</span> обязательны для заполнения.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'firstname'); ?>
        <?php echo $form->textField($model,'firstname',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'firstname'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'surname'); ?>
        <?php echo $form->textField($model,'surname',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'surname'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'middlename'); ?>
        <?php echo $form->textField($model,'middlename',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'middlename'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Изменить'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
