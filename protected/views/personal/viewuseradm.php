
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
<div style="float: left; margin-left: 10%; margin-top: 1%;">
<?php echo CHtml::image(Yii::app()->baseUrl.'/photo/'.$model->photo,'photo',array('width'=>'300' ,'height'=>'200','align'=>'right','class'=>'img-circle'));?>
</div>

<div style="margin-left: 40%; margin-top: 1%;">
<h2>Biodata Diri</h2>


<div style="width: 640px;">	
<?php echo CHtml::beginForm(array('exportdata1')); ?>
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'type' => 'striped hover',
	'attributes'=>array(
		array(
			'label'=>'NIP Anda',
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
			'label'=>'Usia',
			'name'=>'usia',
			'value'=>$model->usia,
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
			'label'=>'Kewarganegaraan',
			'name'=>'kewarganegaraan',
			'value'=>$model->kewarganegaraan,
		),

		array(
			'label'=>'Status Kawin',
			'name'=>'status_perkawinan',
			'value'=>$model->status_perkawinan,
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
			'label'=>'Jenis Jenjang',
			'name'=>'jenis_jenjang',
			'value'=>$model->jenis_jenjang,
		),

		array(
			'label'=>'Nama Jenjang/Sekolah',
			'name'=>'nama_jenjang',
			'value'=>$model->nama_jenjang,
		),

		array(
			'label'=>'Perguruan Tinggi',
			'name'=>'id_pt',
			'value'=>$model->idPt->nama_pt,
		),

		array(
			'label'=>'Strata',
			'name'=>'strata_akhir',
			'value'=>$model->strata_akhir,
		),

		array(
			'label'=>'Jurusan/Fakultas',
			'name'=>'jurusan',
			'value'=>$model->jurusan,
		),

		array(
			'label'=>'Jabatan',
			'name'=>'id_jabatan',
			'value'=>$model->idJabatan->nama_jabatan,
		),

		array(
			'label'=>'Status Kepegawaian',
			'name'=>'status_pegawai',
			'value'=>$model->status_pegawai,
		),

		array(
			'label'=>'Durasi Kerja',
			'name'=>'durasi_kerja',
			'value'=>$model->durasi_kerja,
		),


		/*
		//CONTOH
		array(
	        'header' => 'Level',
	        'name'=> 'ref_level_id',
	        'type'=>'raw',
	        'value' => ($model->Level->name),
	        // 'value' => ($model->status)?"on":"off",
	        // 'value' => @Admin::model()->findByPk($model->createdBy)->username,
	    ),

	    */
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
</div>
</div>


<?php
$no=0;
$idDosen=Yii::app()->user->getId();
$dapet=@$_GET['id'];
$connection=new CDbConnection('mysql:host=localhost;dbname=sudaman','root','');
$connection->active=true; // open connection
    $idd=Yii::app()->user->getId();
    $que="SELECT d.`id`, d.`riwayat`, d.`tahun1`, d.`tahun2`, d.`nip`, d.`no` FROM data_pendidikan d 
    INNER JOIN personal p ON p.`nip` = d.`nip` 
    WHERE d.`nip`='$dapet'";

    $command=$connection->createCommand($que);
    $reader=$command->query();
?>   
<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'<span class="fa fa-archive"></span>  Riwayat Pendidikan Lainnya',
			'titleCssClass'=>''
		));
		?>
<table class="table table-striped">
  <thead class="thead-inverse">
    <tr>
      <th>#</th>
      <th>Tahun Ke-1</th>
      <th>Tahun Ke-2</th>
      <th>Riwayat</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
   <?php foreach ($reader as $row){ ?>
    <tr>
      <th scope="row"><?php echo $no=$no+1?></th>
      <td><?php echo $row['tahun1'];?></td>
      <td><?php echo $row['tahun2'];?></td>
      <td><?php echo $row['riwayat'];?></td>
      <td><?php echo CHtml::link("<img src='/sudaman_bgs/icons/bin-black-full-icon.png' alt=''/>", array('datapendidikan/delete', 'id'=>$row['id']), array('submit'=>array('datapendidikan/delete', 'id'=>$row['id']),'style'=>'margin:2px;','confirm'=>'Apakah Anda yakin akan menghapus data ini ?'));?>
      	<?php echo CHtml::link("<img src='/sudaman_bgs/icons/Pencil-icon.png' alt=''/>", array('datapendidikan/updateuser', 'id'=>$row['id']));?>
      </td>
    </tr>
     <?php } ?>
  </tbody>
</table>

<?php $this->endWidget(); ?>


<?php
$no=0;
$idDosen=Yii::app()->user->getId();
$dapet=@$_GET['id'];
$connection=new CDbConnection('mysql:host=localhost;dbname=sudaman','root','');
$connection->active=true; // open connection
    $idd=Yii::app()->user->getId();
    $que="SELECT r.`id_project`, r.`nama_project`, r.`tgl_project`, r.`rilis_project`, r.`status`, r.`nip`, r.`no` FROM data_project r 
    INNER JOIN personal p ON p.`nip` = r.`nip` 
    WHERE r.`nip`='$dapet'";

    $command=$connection->createCommand($que);
    $reader=$command->query();
?>   
<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'<span class="fa fa-sitemap"></span>  Riwayat Pekerjaan Lainnya',
			'titleCssClass'=>''
		));
		?>
<table class="table table-striped">
  <thead class="thead-inverse">
    <tr>
      <th>#</th>
      <th>Jenis/Nama Proyek</th>
      <th>Tanggal Proyek</th>
      <th>Tanggal Rilis Proyek</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
   <?php foreach ($reader as $row){ ?>
    <tr>
      <th scope="row"><?php echo $no=$no+1?></th>
      <td><?php echo $row['nama_project'];?></td>
      <td><?php echo $row['tgl_project'];?></td>
      <td><?php echo $row['rilis_project'];?></td>
      <td><?php echo $row['status'];?></td>
      <td><?php echo CHtml::link("<img src='/sudaman_bgs/icons/bin-black-full-icon.png' alt=''/>", array('dataproject/delete', 'id'=>$row['id_project']), array('submit'=>array('dataproject/delete', 'id'=>$row['id_project']),'style'=>'margin:2px;','confirm'=>'Apakah anda yakin akan menghapus data ini ?'));?>
      	<?php echo CHtml::link("<img src='/sudaman_bgs/icons/Pencil-icon.png' alt=''/>", array('dataproject/updateuser', 'id'=>$row['id_project']));?>
      </td>
    </tr>
     <?php } ?>
  </tbody>
</table>
<?php $this->endWidget(); ?>


<?php
$no=0;
$idDosen=Yii::app()->user->getId();
$dapet=@$_GET['id'];
$connection=new CDbConnection('mysql:host=localhost;dbname=sudaman','root','');
$connection->active=true; // open connection
    $idd=Yii::app()->user->getId();
    $que="SELECT DISTINCT r.`id_talent`, r.`id_jabatan`, j.`nama_jabatan`, r.`nip`, p.`nama_lengkap`, 
	r.`id_pelatihan`, l.`jenis`, r.`status`, r.`id_kategori`, k.`kategori`, r.`tgl_data`, r.`tgl_mulai`, r.`tgl_selesai`, r.`tempat`, 
	r.`durasi`, r.`keterangan`,
	r.`kode_trainner`, n.`nama_trainner` FROM data_talent r 
	INNER JOIN personal p ON p.`nip` = r.`nip`
	INNER JOIN tbl_jabatan j ON j.`id_jabatan` = r.`id_jabatan`
	INNER JOIN data_kategori k ON k.`id_kategori` = r.`id_kategori`
	INNER JOIN data_trainner n ON n.`kode_trainner` = r.`kode_trainner`
	INNER JOIN data_pelatihan l ON l.`id_pelatihan` = r.`id_pelatihan`
	WHERE r.`nip`='$dapet' AND r.`status` LIKE '%Pass%'";

    $command=$connection->createCommand($que);
    $reader=$command->query();
?>   
<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'<span class="fa fa-check-square"></span>  Data Pelatihan Talenta',
			'titleCssClass'=>''
		));
		?>

<table class="table table-striped">
  <thead class="thead-inverse">
    <tr>
      <th>#</th>
      <th>NIP</th>
      <th>Nama Lengkap</th>
      <th>Jabatan</th>
      <th>Jenis Pelatihan</th>
      <th>Kategori Pelatihan</th>
      <th>Tanggal Mulai</th>
      <th>Tanggal Selesai</th>
      <th>Tempat Penyelenggaraan</th>
      <th>Durasi</th>
      <th>Keterangan</th>
      <th>Trainner</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
   <?php foreach ($reader as $row){ ?>
    <tr>
      <th scope="row"><?php echo $no=$no+1?></th>
      <td><?php echo $row['nip'];?></td>
      <td><?php echo $row['nama_lengkap'];?></td>
      <td><?php echo $row['nama_jabatan'];?></td>
      <td><?php echo $row['jenis'];?></td>
      <td><?php echo $row['kategori'];?></td>
      <td><?php echo $row['tgl_mulai'];?></td>
      <td><?php echo $row['tgl_selesai'];?></td>
      <td><?php echo $row['tempat'];?></td>
      <td><?php echo $row['durasi'];?></td>
      <td><?php echo $row['keterangan'];?></td>
      <td><?php echo $row['nama_trainner'];?></td>
      <td><?php echo $row['status'];?></td>
    </tr>
     <?php } ?>
  </tbody>
</table>
<?php $this->endWidget(); ?>


<?php
if(!isset($_GET['asModal'])){
	$this->endWidget();}
?>

