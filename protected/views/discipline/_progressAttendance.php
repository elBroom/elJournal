<h1>Посещаемость</h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'attendance-grid',    
    'dataProvider'=>$model->search($criteriaAttendance),
    'filter'=>$model,
    'afterAjaxUpdate' => 'reinstallDatePicker',
    'emptyText' => 'По выбранной дисциплине не проводилось ни одно занятие',
    'columns'=>array(
        array(
        	'name' => 'date',
        	'type'=>'raw',
        	'value' => '$data->lesson->date',
        	'filter' => false,
        		'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        	        'model' => $model,
        	  		'id' => 'date2',
        	        'attribute' => 'date',
                    'language'=>'ru',
        	    	'htmlOptions' => array('style' => 'width: 80px;'),
        	        'options' => array(
        	            'dateFormat' => 'yy-mm-dd',
        	            'changeYear' => true),
        	        
        		), true),
        	),
        'attendance' => array(
            'name' => 'attendance',
            'value' => '($data->attendance == 1) ? "Отсутствовал":"Присутствовал"',
            'filter' => array('1' => 'Отсутствовал', '0' => 'Присутствовал'),
            ),
        array(
        	'name' => 'surname',
        	'type'=>'raw',
        	'value' => '$data->user->surname',
        	
        	),
        array(
        	'name' => 'firstname',
        	'type'=>'raw',
        	'value' => '$data->user->firstname',
        	),
        array(
        	'name' => 'middlename',
        	'type'=>'raw',
        	'value' => '$data->user->middlename',
        	),
        
    ),
)); ?>
