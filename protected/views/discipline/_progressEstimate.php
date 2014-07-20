<h1>Успеваемость</h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'estimate-grid',    
    'dataProvider'=>$model->search($criteriaEstimate),
    'filter'=>$model,
    'afterAjaxUpdate' => 'reinstallDatePicker',
    'emptyText' => 'По выбранной дисциплине не проводилось ни одно занятие',
    'columns'=>array(
        array(
        	'name' => 'date',
        	'type'=>'raw',
        	'value' => '$data->lesson->date',
        	'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model,
          		'id' => 'date',
                'attribute' => 'date',
                'language'=>'ru',
            	'htmlOptions' => array('style' => 'width: 80px;'),
                'options' => array(
                    'dateFormat' => 'yy-mm-dd',
                    'changeYear' => true),
                
        	), true),
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
        'estimate',
        
    ),
)); ?>