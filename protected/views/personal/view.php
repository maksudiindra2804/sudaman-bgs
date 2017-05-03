<?php
function indonesian_date ($timestamp = '', $date_format = 'j F Y') {
    if (trim ($timestamp) == '')
    {
            $timestamp = time ();
    }
    elseif (!ctype_digit ($timestamp))
    {
        $timestamp = strtotime ($timestamp);
    }
    # remove S (st,nd,rd,th) there are no such things in indonesia :p
    $date_format = preg_replace ("/S/", "", $date_format);
    $pattern = array (
        '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
        '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
        '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
        '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
        '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
        '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
        '/April/','/June/','/July/','/August/','/September/','/October/',
        '/November/','/December/',
    );
    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
        'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
        'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
        'Januari','Februari','Maret','April','Juni','Juli','Agustus','September',
        'Oktober','November','Desember',
    );
    $date = date ($date_format, $timestamp);
    $date = preg_replace ($pattern, $replace, $date);
    $date = "{$date}";
    return $date;
} 
;?>
<?php

if(!isset($_GET['asModal'])){
?>
<?php $box = $this->beginWidget(
    'bootstrap.widgets.TbBox',
    array(
        'title' => 'Biodata Diri',
        'headerIcon' => 'icon- fa fa-user',
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
			'label'=>'NIP',
			'name'=>'nip',
			'value'=>$model->nip,
		),

		array(
			'label'=>'Nama Lengkap',
			'name'=>'nama_lengkap',
			'value'=>$model->nama_lengkap,
		),

		array(
			'label'=>'Agama',
			'name'=>'agama',
			'value'=>$model->agama,
		),
		array(
			'label'=>'Tempat, Tanggal Lahir',
		    'name'=> 'tgl_lahir',
		    'type'=>'raw',
		    'value' => $model->tempat_lahir.', '. indonesian_date($model->tgl_lahir),
		),

		array(
			'label'=>'Jenis Kelamin',
			'name'=>'jenkel',
			'value'=>$model->jenkel,
		),

		array(
			'label'=>'Golongan Darah',
			'name'=>'goldar',
			'value'=>$model->goldar,
		),

		array(
			'label'=>'Alamat Lengkap',
			'name'=>'alamat',
			'value'=>$model->alamat.'. Kode Pos: '.$model->kode_pos.'. '.$model->provinsi->nama_provinsi.'. '.$model->idKotkab->nama_kotkab,
		),

		array(
			'label'=>'No. Telepon',
			'name'=>'no_telp',
			'value'=>$model->no_telp,
		),

		array(
			'label'=>'Kewarganegaran',
			'name'=>'kewarganegaraan',
			'value'=>$model->kewarganegaraan,
		),

		array(
			'label'=>'Status Kawin',
			'name'=>'status_perkawinan',
			'value'=>$model->status_perkawinan,
		),

		array(
			'label'=>'Usia',
			'name'=>'usia',
			'value'=>$model->usia,
		),

		array(
			'label'=>'Jenis Jenjang',
			'name'=>'jenis_jenjang',
			'value'=>$model->jenis_jenjang,
		),

		array(
			'label'=>'Nama Sekolah',
			'name'=>'nama_jenjang',
			'value'=>$model->nama_jenjang,
		),

		array(
			'label'=>'Perguruan Tinggi',
			'name'=>'id_pt',
			'value'=>$model->idPt->nama_pt,
		),

		array(
			'label'=>'Jurusan',
			'name'=>'jurusan',
			'value'=>$model->jurusan,
		),

		array(
			'label'=>'Strata',
			'name'=>'strata_akhir',
			'value'=>$model->strata_akhir,
		),

		array(
			'label'=>'Username',
			'name'=>'username',
			'value'=>$model->username,
		),

		array(
			'label'=>'E-mail',
			'name'=>'email',
			'value'=>$model->email,
		),

		array(
			'label'=>'Tanggal Data',
			'name'=>'tgl_data',
			'value'=>$model->tgl_data,
		),

		array(
			'label'=>'User Role',
			'name'=>'id_role',
			'value'=>$model->idRole->role,
		),

		array(
			'label'=>'Status Pegawai',
			'name'=>'status_pegawai',
			'value'=>$model->status_pegawai,
		),

		array(
			'label'=>'Jabatan',
			'name'=>'id_jabatan',
			'value'=>$model->idJabatan->nama_jabatan,
		),

		array(
			'label'=>'Masa Kerja',
			'name'=>'durasi_kerja',
			'value'=>$model->durasi_kerja,
		),

	),
)); ?>

<?php
if(!isset($_GET['asModal'])){
	$this->endWidget();}
?>