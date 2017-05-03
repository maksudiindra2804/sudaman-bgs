<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#data-talent-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $box = $this->beginWidget(
    'bootstrap.widgets.TbBox',
    array(
        'title' => 'Data Talenta',
        'headerIcon' => 'icon- fa fa-check-square',
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

<?php echo CHtml::beginForm(array('export')); ?>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'data-talent-grid',
	'dataProvider'=>$model->search2($model->nip=Yii::app()->user->getId()),
	'filter'=>$model,
	'type' => 'striped hover', //bordered condensed
	'columns'=>array(

			array(
		        'header' => 'NIP',
		        'name'=> 'nip',
		        'type'=>'raw',
		        'value' => '($data->nip0->nip)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),

		    array(
		        'header' => 'Nama Lengkap',
		        'name'=> 'nama_lengkap',
		        'type'=>'raw',
		        'value' => '($data->nip0->nama_lengkap)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),

			array(
		        'header' => 'Jabatan',
		        'name'=> 'id_jabatan',
		        'type'=>'raw',
		        'value' => '($data->idJabatan->nama_jabatan)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),
			
			array(
		        'header' => 'Jenis Pelatihan',
		        'name'=> 'id_pelatihan',
		        'type'=>'raw',
		        'value' => '($data->idPelatihan->jenis)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),

		    array(
		        'header' => 'Kategori',
		        'name'=> 'id_kategori',
		        'type'=>'raw',
		        'value' => '($data->idKategori->kategori)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),

			array(
		        'header' => 'Tanggal Mulai Penyelenggaraan',
		        'name'=> 'tgl_mulai',
		        'type'=>'raw',
		        'value' => '($data->tgl_mulai)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),
			
			array(
		        'header' => 'Tanggal Selesai Pelatihan',
		        'name'=> 'tgl_selesai',
		        'type'=>'raw',
		        'value' => '($data->tgl_selesai)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),

		    array(
		        'header' => 'Status Pelatihan',
		        'name'=> 'status',
		        'type'=>'raw',
		        'value' => '($data->status)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),

		    array(
		        'header' => 'Tempat Penyelenggaraan',
		        'name'=> 'tempat',
		        'type'=>'raw',
		        'value' => '($data->tempat)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),
			
			array(
		        'header' => 'Durasi Pelatihan',
		        'name'=> 'durasi',
		        'type'=>'raw',
		        'value' => '($data->durasi)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),

		    array(
		        'header' => 'Keterangan Pelatihan',
		        'name'=> 'keterangan',
		        'type'=>'raw',
		        'value' => '($data->keterangan)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),

		    array(
		        'header' => 'Trainner',
		        'name'=> 'kode_trainner',
		        'type'=>'raw',
		        'value' => '($data->kodeTrainner->nama_trainner)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),
	    
	    array(
	    	'class'=>'CButtonColumn',
	    	'template'=>'{view}',
	    	'buttons'=>array(

	    		'view'=>array(
	    			'url' => '$data->id_talent."|".$data->nip',  
	    			'imageUrl'=>Yii::app()->request->baseUrl.'/icons/Search-Computer-icon.png',
	    			'label'=>'Detail',            
                	'click' => 'function(){
                		data=$(this).attr("href").split("|")
                		$("#myModalHeader").html(data[1]);
	        			$("#myModalBody").load("'.$this->createUrl('view').'&id="+data[0]+"&asModal=true");
                		$("#myModal").modal();
                		return false;
                	}', 
	    			),
	    	),
	    ),
	),
)); ?>

<select name="fileType" style="width:150px;">
	<option value="Excel5">EXCEL (xls)</option>
	<option value="PDF">PDF</option>
</select>
<br>

<?php 
$this->widget('bootstrap.widgets.TbButton', array(
	'buttonType'=>'submit', 'icon'=>'fa fa-print','label'=>'Export', 'type'=> 'primary'));
?>
<?php echo CHtml::endForm(); ?>

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
