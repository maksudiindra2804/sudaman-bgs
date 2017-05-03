<?php

$menu=array();
require(dirname(__FILE__).DIRECTORY_SEPARATOR.'_menu.php');
$this->menu=array(
	array('label'=>'Menu','url'=>array('index'),'icon'=>'fa fa-list-alt', 'items' => $menu)	
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tbl-absensi-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $box = $this->beginWidget(
    'bootstrap.widgets.TbBox',
    array(
        'title' => 'Data Absensi Pegawai',
        'headerIcon' => 'icon- fa fa-clock-o',
        'headerButtons' => array(
            array(
                'class' => 'bootstrap.widgets.TbButtonGroup',
                'type' => 'success',
                // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'buttons' => $this->menu
            ),
        ) 
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

<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php echo CHtml::beginForm(array('export')); ?>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'tbl-absensi-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type' => 'striped hover', //bordered condensed
	'columns'=>array(
			array(
		        'header' => 'NIP',
		        'name'=> 'nip',
		        'type'=>'raw',
		        'value' => '($data->nip)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),
			
			array(
		        'header' => 'Jam Datang',
		        'name'=> 'absen_datang',
		        'type'=>'raw',
		        'value' => '($data->absen_datang)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),

		    array(
		        'header' => 'Absen Pulang',
		        'name'=> 'absen_pulang',
		        'type'=>'raw',
		        'value' => '($data->absen_pulang)',
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
		        'header' => 'Keterangan Lembur',
		        'name'=> 'keterangan',
		        'type'=>'raw',
		        'value' => '($data->keterangan)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),

		   	array(
		        'header' => 'Total Lembur',
		        'name'=> 'total_jam',
		        'type'=>'raw',
		        'value' => '($data->total_jam)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),
			
	    array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'buttons'=>array
            (
                'view' => array
                (    
                	'url' => '$data->id_absen."|".$data->nip',              
                	'click' => 'function(){
                		data=$(this).attr("href").split("|")
                		$("#myModalHeader").html(data[1]);
	        			$("#myModalBody").load("'.$this->createUrl('view').'&id="+data[0]+"&asModal=true");
                		$("#myModal").modal();
                		return false;
                	}', 
                ),
            )
		),
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
                'label' => 'Keluar',
                'url' => '#',
                'htmlOptions' => array('data-dismiss' => 'modal'),
            )
        ); ?>
    </div>
 
<?php  $this->endWidget(); ?>
