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
	$('#data-kompensasi-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $box = $this->beginWidget(
    'bootstrap.widgets.TbBox',
    array(
        'title' => 'Kelola Data Kompensasi Pegawai',
        'headerIcon' => 'icon- fa fa-tasks',
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

<?php echo CHtml::link('Cari','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php echo CHtml::beginForm(array('export')); ?>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'data-kompensasi-grid',
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
		        'header' => 'Data Talenta',
		        'name'=> 'id_talent',
		        'type'=>'raw',
		        'value' => '($data->idTalent->keterangan)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),

		    array(
		        'header' => 'Status Pelatihan Talenta',
		        'name'=> 'id_talent',
		        'type'=>'raw',
		        'value' => '($data->idTalent->status)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),
			
			array(
		        'header' => 'Keterangan Pelatihan Karier',
		        'name'=> 'id_karier',
		        'type'=>'raw',
		        'value' => '($data->idKarier->keterangan)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),

		    array(
		        'header' => 'Deksripsi Pelatihan Karier',
		        'name'=> 'id_karier',
		        'type'=>'raw',
		        'value' => '($data->idKarier->deskripsi)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),

		    array(
		        'header' => 'Status Pelatihan Karier',
		        'name'=> 'id_karier',
		        'type'=>'raw',
		        'value' => '($data->idKarier->status)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),

			array(
		        'header' => 'Data Absensi Lembur',
		        'name'=> 'id_absen',
		        'type'=>'raw',
		        'value' => '($data->idAbsen->status)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),

			array(
		        'header' => 'Total Jam Lembur',
		        'name'=> 'id_absen',
		        'type'=>'raw',
		        'value' => '($data->idAbsen->total_jam)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),

			array(
		        'header' => 'Jenis Kompensasi',
		        'name'=> 'jenis_reward',
		        'type'=>'raw',
		        'value' => '($data->jenis_reward)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),

			array(
		        'header' => 'Keterangan Kompensasi',
		        'name'=> 'keterangan_reward',
		        'type'=>'raw',
		        'value' => '($data->keterangan_reward)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),

			array(
		        'header' => 'Jumlah Kompensasi',
		        'name'=> 'jumlah',
		        'type'=>'raw',
		        'value' => '($data->jumlah)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),

/*
			array(
		        'header' => 'Tgl_data',
		        'name'=> 'tgl_data',
		        'type'=>'raw',
		        'value' => '($data->tgl_data)',
		        'class' => 'bootstrap.widgets.TbEditableColumn',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
				'editable' => array(
					'type'    => 'textarea',
					'url'     => $this->createUrl('editable'),
					'params' => array('YII_CSRF_TOKEN' => Yii::app()->request->csrfToken),
				)
		    ),
			
*/
	    array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'buttons'=>array
            (
                'view' => array
                (    
                	'url' => '$data->id_kompensasi."|".$data->nip',              
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

<select name="fileType" style="width:150px;">
	<option value="Excel5">EXCEL (xls)</option>
	<option value="PDF">PDF</option>
	<option value="WORD">WORD (docx)</option>
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
