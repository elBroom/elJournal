<h1><?php echo $this->pageTitle;?></h1>
<?php echo CHtml::dropDownList('specialty','',Specialty::getAll(), array('empty'=>'Выберите пункт'))?>
<div id="newRecord">
</div>
<?//php $this->renderPartial('_form', array('model'=>$discipline)); ?>
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<script>
    $('#specialty').change(function() {
        $.ajax({
            type: 'POST',
            url: location,
            data:{  id_speciality: $(this).val()},
            success: function(data){
                $('#newRecord').html(data);
            }
        });
    });
</script>