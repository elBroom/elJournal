<?php $this->pageTitle = 'Изменение пароля'?>
<h1><?php echo $this->pageTitle;?></h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'user-password-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Поля с <span class="required">*</span> обязательны для заполнения.</p>

    <?php echo $form->errorSummary($model); ?>


    <div class="row">
        <?php echo $form->labelEx($model,'curPass'); ?>
        <?php echo $form->passwordField($model,'curPass'); ?>
        <?php echo $form->error($model,'curPass'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'pass1'); ?>
        <?php echo $form->passwordField($model,'pass1'); ?>
        <?php echo $form->error($model,'pass1'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'pass2'); ?>
        <?php echo $form->passwordField($model,'pass2'); ?>
        <?php echo $form->error($model,'pass2'); ?>
    </div>

    
    <div class="row buttons">
        <?php echo CHtml::submitButton('Изменить'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->