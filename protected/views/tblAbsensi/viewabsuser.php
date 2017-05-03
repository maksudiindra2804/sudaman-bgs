
<?php $box = $this->beginWidget(
    'bootstrap.widgets.TbBox',
    array(
        'title' => 'Data Absensi Lembur',
        'headerIcon' => 'icon- fa fa-clock-o',

    )
);?>		<?php $this->widget('bootstrap.widgets.TbAlert', array(
		    'block'=>false, // display a larger alert block?
		    'fade'=>true, // use transitions?
		    'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
		    'alerts'=>array( // configurations per alert type
		        'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), //success, info, warning, error or danger
		        'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), //success, info, warning, error or danger
		        'warning'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), //success, info, warning, error or danger
		        'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), //success, info, warning, error or danger
		        'danger'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), //success, info, warning, error or danger
		    ),
		));
		?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'tbl-absensi-grid',
	'dataProvider'=>$model->search($model->nip=Yii::app()->user->getId()),
	'filter'=>$model,
	'type' => 'striped hover', //bordered condensed
	'columns'=>array(
			array(
		        'header' => 'NIP',
		        'name'=> 'nip',
		        'type'=>'raw',
		        'value' => '($data->nip)',
		        //'class' => 'bootstrap.widgets.TbEditableColumn',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),
			
			array(
		        'header' => 'Waktu Absen',
		        'name'=> 'absen_datang',
		        'type'=>'raw',
		        'value' => '($data->absen_datang)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),
			
			array(
		        'header' => 'Status',
		        'name'=> 'status',
		        'type'=>'raw',
		        'value' => '($data->status)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),

		    array(
		        'header' => 'Keterangan',
		        'name'=> 'keterangan',
		        'type'=>'raw',
		        'value' => '($data->keterangan)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),

		    array(
		        'header' => 'Jam Pulang',
		        'name'=> 'absen_pulang',
		        'type'=>'raw',
		        'value' => '($data->absen_pulang)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),

		   	array(
		        'header' => 'Total Lembur',
		        'name'=> 'total_jam',
		        'type'=>'raw',
		        'value' => '($data->total_jam)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),
			
		/*
		//Contoh
		array(
	        'header' => 'Level',
	        'name'=> 'ref_level_id',
	        'type'=>'raw',
	        'value' => '($data->Level->name)',
	        // 'value' => '($data->status)?"on":"off"',
	    ),
	    */
	    array(
	    	'class'=>'CButtonColumn',
	    	'template'=>'{view}',
	    	'buttons'=>array(

	    		'view'=>array(
	    			'url' => '$data->id_absen."|".$data->nip',  
	    			'imageUrl'=>Yii::app()->request->baseUrl.'/icons/Search-Computer-icon.png',
	    			'label'=>'Detail',            
                	'click' => 'function(){
                		data=$(this).attr("href").split("|")
                		$("#myModalHeader").html(data[1]);
	        			$("#myModalBody").load("'.$this->createUrl('viewpop').'&id="+data[0]+"&asModal=true");
                		$("#myModal").modal();
                		return false;
                	}', 
	    			),
	    	),
	    ),
	   /* array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'buttons'=>array
            (
                'view' => array
                (    
                	'url' => '$data->id_absen."|".$data->id_absen',              
                	'click' => 'function(){
                		data=$(this).attr("href").split("|")
                		$("#myModalHeader").html(data[1]);
	        			$("#myModalBody").load("'.$this->createUrl('view').'&id="+data[0]+"&asModal=true");
                		$("#myModal").modal();
                		return false;
                	}', 
                ),
            )
		),*/
	),
)); ?>
<?php $this->endWidget(); ?>
<?php  $this->beginWidget(
    'bootstrap.widgets.TbModal',
    array('id' => 'myModal')
); ?>
 
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4 id="myModalHeader">Modal header</h4>
    </div>
 
    <div class="modal-body" id="myModalBody">
        <p>Data Kosong</p>
    </div>
 
    <div class="modal-footer">
        <?php  $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'label' => 'Close',
                'url' => '#',
                'htmlOptions' => array('data-dismiss' => 'modal'),
            )
        ); ?>
    </div>
 
<?php  $this->endWidget(); ?>
