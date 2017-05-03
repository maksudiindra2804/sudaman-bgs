<?php

$menu=array();
require(dirname(__FILE__).DIRECTORY_SEPARATOR.'_menu.php');


$menu2=array(
	array('label'=>'Menu','url'=>array('index'),'icon'=>'fa fa-list-alt', 'items' => $menu)	
);

if(!isset($_GET['asModal'])){
?>
<?php $box = $this->beginWidget(
    'bootstrap.widgets.TbBox',
    array(
        'title' => 'Lihat Data Karier Pegawai',
        'headerIcon' => 'icon- fa fa-eye',
        'headerButtons' => array(
            array(
                'class' => 'bootstrap.widgets.TbButtonGroup',
                'type' => 'success',
                // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'buttons' => $menu2
            ),
        ) 
    )
);?>
<?php
}
?>

		<?php $this->widget('bootstrap.widgets.TbAlert', array(
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
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		//'id_karier',
		array(
			'label'=>'NIP Pegawai',
			'name'=>'nip',
			'value'=>$model->nip0->nip,
		),

		array(
			'label'=>'Nama Lengkap',
			'name'=>'nama_lengkap',
			'value'=>$model->nip0->nama_lengkap,
		),

		array(
			'label'=>'Jabatan Pegawai',
			'name'=>'id_jabatan',
			'value'=>$model->idJabatan->nama_jabatan,
		),

		array(
			'label'=>'Tanggal Pelatihan',
			'name'=>'tgl_pelatihan',
			'value'=>$model->tgl_pelatihan,
		),

		array(
			'label'=>'Tanggal Data',
			'name'=>'tgl_data',
			'value'=>$model->tgl_data,
		),

		array(
			'label'=>'Deskripsi Pelatihan Karier',
			'name'=>'deskripsi',
			'value'=>$model->deskripsi,
		),

		array(
			'label'=>'Keterangan Pelatihan',
			'name'=>'keterangan',
			'value'=>$model->keterangan,
		),

		array(
			'label'=>'Mapping Kompetensi',
			'name'=>'id_mapping',
			'value'=>$model->idMapping->mapping,
		),

		array(
			'label'=>'Detail Kompetensi',
			'name'=>'id_mapping',
			'value'=>$model->idMapping->child_mapping,
		),

		array(
			'label'=>'Status',
			'name'=>'status',
			'value'=>$model->status,
		),
	),
)); ?>

<?php
if(!isset($_GET['asModal'])){
	$this->endWidget();}
?>