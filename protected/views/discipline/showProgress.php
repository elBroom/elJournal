<?php $this->pageTitle = 'Отчет по дисциплине';?>
<h1><?php echo $this->pageTitle;?></h1>

<div class="form">
	<div class="row">
        <?php echo CHtml::dropDownList('Discipline_title','', $discipline->allForTeacher()); ?>
    </div>
</div>

<div id="showProgress">
<?php $this->renderPartial('_progressAttendance', array(
                'model' => $model,
                'criteriaAttendance' => $criteriaAttendance,
                ));?>
<?php $this->renderPartial('_progressEstimate', array(
                'model' => $model,
                'criteriaEstimate' => $criteriaEstimate,
                ));?>

</div>



<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<script>
    function reinstallDatePicker() {
        $('#date').datepicker({ dateFormat: "yy-mm-dd"});
        $('#date2').datepicker({ dateFormat: "yy-mm-dd"});
        $.datepicker.setDefaults($.datepicker.regional['ru']);
    }
	$('#Discipline_title').change(function() {
        $.ajax({
            type: 'POST',
            url: location,
            data:{  id_discipline: $(this).val()},
            success: function(data){
                $('#showProgress').html(data);
                reinstallDatePicker();
            }
        });
    });
</script>