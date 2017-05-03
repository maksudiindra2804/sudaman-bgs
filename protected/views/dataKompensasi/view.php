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
        'title' => 'Lihat Data Kompensasi',
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
			'label'=>'Nama Lengkap',
			'name'=>'nama_lengkap',
			'value'=>$model->nip0->nama_lengkap,
		),

		array(
			'label'=>'Jabatan',
			'name'=>'id_jabatan',
			'value'=>$model->idJabatan->nama_jabatan,
		),

		array(
			'label'=>'Data Pelatihan Talenta',
			'name'=>'id_talent',
			'value'=>$model->idTalent->keterangan,
		),

		array(
			'label'=>'Status Pelatihan Talenta',
			'name'=>'id_talent',
			'value'=>$model->idTalent->status,
		),

		array(
			'label'=>'Keterangan Pelatihan Karier',
			'name'=>'id_karier',
			'value'=>$model->idKarier->keterangan,
		),

		array(
			'label'=>'Deskripsi Pelatihan Karier',
			'name'=>'id_karier',
			'value'=>$model->idKarier->deskripsi,
		),

		array(
			'label'=>'Status Pelatihan Karier',
			'name'=>'id_karier',
			'value'=>$model->idKarier->status,
		),

		array(
			'label'=>'Data Absensi Lembur',
			'name'=>'id_absen',
			'value'=>$model->idAbsen->status,
		),

		array(
			'label'=>'Total Jam Lembur',
			'name'=>'id_absen',
			'value'=>$model->idAbsen->total_jam,
		),

		array(
			'label'=>'Jenis Kompensasi',
			'name'=>'jenis_reward',
			'value'=>$model->jenis_reward,
		),

		array(
			'label'=>'Keterangan Kompensasi',
			'name'=>'keterangan_reward',
			'value'=>$model->keterangan_reward,
		),

		array(
			'label'=>'Jumlah Kompensasi',
			'name'=>'jumlah',
			'value'=>$model->jumlah,
		),

		array(
			'label'=>'Tanggal Data',
			'name'=>'tgl_data',
			'value'=>$model->tgl_data,
		),

	),
)); ?>

<?php
if(!isset($_GET['asModal'])){
	$this->endWidget();}
?>