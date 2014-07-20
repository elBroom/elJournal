<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<?php $this->pageTitle = 'Изменение дисциплины: '.$discipline->discipline->title;?>
<h1><?php echo $this->pageTitle;?></h1>
<div id="addStudents">
	<?php $this->renderPartial('_addStudents', array('inUsers'=>$inUsers, 'outUsers'=>$outUsers));?>
</div>
<script>
	$('#id_group').change(function() {
		if($(this).val() > 0){
		    $.ajax({
		        type: 'POST',
		        url: location,
		        data:{  id_group: $(this).val()},
		        success: function(data){
		            $('#addStudents').html(data);
		        }
		    });
		} else
			$('#addStudents').html('');
	});
</script>