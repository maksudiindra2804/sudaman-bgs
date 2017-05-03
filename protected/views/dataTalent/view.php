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
        'title' => 'Lihat Data Pelatihan',
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

		array(
			'label'=>'NIP Pegawai',
			'name'=>'nip',
			'value'=>$model->nip0->nip,
		),

		array(
			'label'=>'Nama Pegawai',
			'name'=>'nama_lengkap',
			'value'=>$model->nip0->nama_lengkap,
		),

		array(
			'label'=>'Jabatan Pegawai',
			'name'=>'id_jabatan',
			'value'=>$model->idJabatan->nama_jabatan,
		),

		array(
			'label'=>'Jenis Pelatihan',
			'name'=>'id_pelatihan',
			'value'=>$model->idPelatihan->jenis,
		),

		array(
			'label'=>'Kategori Pelatihan',
			'name'=>'id_kategori',
			'value'=>$model->idKategori->kategori,
		),

		array(
			'label'=>'Tanggal Mulai Penyelenggaraan',
			'name'=>'tgl_mulai',
			'value'=>$model->tgl_mulai,
		),

		array(
			'label'=>'Tanggal Selesai Penyelenggaraan',
			'name'=>'tgl_selesai',
			'value'=>$model->tgl_selesai,
		),

		array(
			'label'=>'Status Pelatihan',
			'name'=>'status',
			'value'=>$model->status,
		),

		array(
			'label'=>'Tempat Penyelenggaraan',
			'name'=>'tempat',
			'value'=>$model->tempat,
		),

		array(
			'label'=>'Durasi Pelatihan',
			'name'=>'durasi',
			'value'=>$model->durasi,
		),

		array(
			'label'=>'Keterangan Pelatihan',
			'name'=>'keterangan',
			'value'=>$model->keterangan,
		),

		array(
			'label'=>'Trainner',
			'name'=>'kode_trainner',
			'value'=>$model->kodeTrainner->nama_trainner,
		),
	),
)); ?>

<?php
if(!isset($_GET['asModal'])){
	$this->endWidget();}
?>