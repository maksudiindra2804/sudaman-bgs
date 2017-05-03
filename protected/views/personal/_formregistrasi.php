<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'personal-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Kolom dengan tanda <span class="required">*</span> wajib di isi !</p>

	<?php echo $form->errorSummary($model); ?>

<div style="float: left; margin-top: 1%;">

	<div style="margin-top: 1%; margin-left: 1%;">
	<label class="control-label">NIP <span class="required">*</span>
	</label>
	</div>

	<div style="margin-top: -6%; margin-left: 29%;">
	<?php echo $form->textField($model,'nip',array('class'=>'span5','maxlength'=>30,'placeholder'=>'Nomor Induk Pegawai')); ?>
	</div>

	<div style="margin-top: 1%; margin-left: 1%;">
	<label class="control-label">Nama Lengkap <span class="required">*</span>
	</label>
	</div>

	<div style="margin-top: -6%; margin-left: 29%;">
	<?php echo $form->textField($model,'nama_lengkap',array('class'=>'span5','maxlength'=>100,'placeholder'=>'Nama Lengkap')); ?>
	</div>

	<div style="margin-top: 1%; margin-left: 1%;">
	<label class="control-label">Agama </label>
	</div>

	<div style="margin-top: -6%; margin-left: 29%;">
	<?php
	echo $form->dropDownList($model,
                        'agama',
                        array('Islam'=>'Islam','Kristen'=>'Kristen','Khatolik'=>'Khatolik','Budha'=>'Budha','Hindu'=>'Hindu'),
                        array('empty'=>'Pilih Agama','class'=>'span5'));
                        ;?>
    </div>

    <div style="margin-top: 1%; margin-left: 1%;">
	<label class="control-label">Tanggal Lahir </label>
	</div>

	<div style="margin-top: -6%; margin-left: 29%;">
	<?php echo $form->datepickerRow($model,'tgl_lahir',
								array(
					                'options' => array(
					                    'language' => 'id',
					                    'format' => 'yyyy-mm-dd', 
					                    'weekStart'=> 1,
					                    'autoclose'=>'true',
					                    'keyboardNavigation'=>true,
					                ), 
					            ),
					            array(
					                'prepend' => '<i class="icon-calendar"></i>'
					            )
			);; ?>
	</div>

	<div style="margin-top: 2%; margin-left: 1%;">
	<label class="control-label">Tempat Lahir </label>
	</div>

	<div style="margin-top: -6%; margin-left: 29%;">
	<?php echo $form->textField($model,'tempat_lahir',array('class'=>'span5','maxlength'=>50,'placeholder'=>'Tempat Lahir')); ?>
	</div>

	<div style="margin-top: 1%; margin-left: 1%;">
	<label class="control-label">Jenis Kelamin </label>
	</div>

	<div style="margin-top: -6%; margin-left: 29%;">
	<?php
    $x=array(	'Pria'=>'Pria',
                'Wanita'=>'Wanita');
     echo $form->radioButtonList($model,'jenkel', $x,array('labelOptions'=>array('style'=>'display:inline'), 'separator'=>'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp')); ?>
	</div>

	<div style="margin-top: 2%; margin-left: 1%;">
	<label class="control-label">Golongan Darah </label>
	</div>

	<div style="margin-top: -6%; margin-left: 29%;">
	<?php
    $y=array(	'A'=>'A',
                'B'=>'B',
                'AB'=>'AB',
                'O'=>'O');
     echo $form->radioButtonList($model,'goldar', $y,array('labelOptions'=>array('style'=>'display:inline'), 'separator'=>'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp')); ?>
	</div>

	<div style="margin-top: 3%; margin-left: 1%;">
	<label class="control-label">Usia </label>
	</div>

	<div style="margin-top: -6%; margin-left: 29%;">
	<?php echo $form->textField($model,'usia',array('class'=>'span1','placeholder'=>'Usia'));?>
	</div>

	<div style="margin-top: 2%; margin-left: 1%;">
	<label class="control-label">Alamat </label>
	</div>

	<div style="margin-top: -6%; margin-left: 29%;">
	<?php echo $form->textArea($model,'alamat',array('class'=>'span5','rows'=>5,'placeholder'=>'Sertakan RT/RW, Kelurahan dan Kecamatan'));?>
	</div>

	<div style="margin-top: 2%; margin-left: 1%;">
	<label class="control-label">Provinsi </label>
	</div>

	<div style="margin-top: -6%; margin-left: 29%;">
	<?php echo $form->labelEx($model,''); ?>
	<?php
	echo $form->DropDownList($model,'provinsi_id',
		CHtml::listData(TblProvinsi::model()->findAll(),'provinsi_id','nama_provinsi'),
		array(
			'prompt'=>'Pilih Provinsi',
			'class'=>'span5',
			'ajax' => array(
				'type'=>'POST',
				'url'=>CController::createUrl('Personal/lookupprovinsi'), //selectjur adalah actionSelectjur di ProfilController.
				'update'=>'#'.CHtml::activeId($model,'id_kotkab'), //jurusan_id = field jurusan_id
				'beforeSend'=>'function() { 
					$("#Personal_id_kotkab").find("option").remove();
				}',
				//Bila tidak menggunakan ini, maka yg terupdate hanya jurusan (bawaan 'update').
				)
			)
		);
		?>
		<?php echo $form->error($model,'provinsi_id'); ?>
	</div>

	<div style="margin-top: 2%; margin-left: 1%;">
	<label class="control-label">Kota/Kabupaten </label>
	</div>

	<div style="margin-top: -6%; margin-left: 29%;">
	<?php echo $form->labelEx($model,''); ?>
	<?php echo $form->dropDownList($model,'id_kotkab',
		(!$model->isNewRecord) ? $model->kotkabList() :array(),
		array(
			'class'=>'span5',
			'prompt'=>'Pilihan Kota/Kabupaten',
			)
			); ?> 
			<?php echo $form->error($model,'id_kotkab'); ?>
	</div>

	<div style="margin-top: 2%; margin-left: 1%;">
	<label class="control-label">Kode Pos </label>
	</div>

	<div style="margin-top: -6%; margin-left: 29%;">
	<?php echo $form->textField($model,'kode_pos',array('class'=>'span2','maxlength'=>20,'placeholder'=>'Kode Pos')); ?>
	</div>

	<div style="margin-top: 2%; margin-left: 1%;">
	<label class="control-label">No. Telepon </label>
	</div>

	<div style="margin-top: -6%; margin-left: 29%;">
	<?php echo $form->textField($model,'no_telp',array('class'=>'span5','maxlength'=>20,'placeholder'=>'Atau Nomor Handphone')); ?>
	</div>

</div> <!-- End Float Left -->



<div style="float: right; margin-top: 1%;">

	<div style="margin-left: -34%; margin-top: 1%;">
	<label class="control-label">Kewarganegaraan</label>
	</div>

	<div style="margin-left: -2%; margin-top: -6%;">
	<?php echo $form->textField($model,'kewarganegaraan',array('class'=>'span5','maxlength'=>80,'placeholder'=>'Kewarganegaraan')); ?>
	</div>

	<div style="margin-left: -34%; margin-top: 1%;">
	<label class="control-label">Status Kawin</label>
	</div>

	<div style="margin-left: -2%; margin-top: -6%;">
	<?php
	$selections = array(
		'Belum Kawin'=>'Belum Kawin',
		'Kawin'=>'Kawin',
		);
		?>
	<?php echo $form->dropDownList($model, 'status_perkawinan', $selections,array('class'=>'span5')); ?>
	<?php echo $form->error($model,'status_perkawinan'); ?>
	</div>

	<div style="margin-left: -34%; margin-top: 1%;">
	<label class="control-label">Jenjang Pendidikan</label>
	</div>

	<div style="margin-left: -2%; margin-top: -6%;">
	<?php
	$selections = array(
		//'prompt'=>'Pilih Lulusan',
		'SMA/SMK'=>'SMA/SMK',
		'Perguruan Tinggi'=>'Perguruan Tinggi',
		);
		?>
	<?php echo $form->dropDownList($model, 'jenis_jenjang', $selections,array('class'=>'span5')); ?>
	<?php echo $form->error($model,'jenis_jenjang'); ?>
	</div>

	<div id="perguruan">
	<div style="margin-left: -34%; margin-top: 1%;">
	<label class="control-label">Asal Perguruan Tinggi</label>
	</div>

	<div style="margin-left: -2%; margin-top: -6%;">
	<?php 
	$type_list=CHtml::listData(TblPt::model()->findAll(),'id_pt','nama_pt');
	echo CHtml::activeDropDownList($model,
		'id_pt',
		$type_list,
		array('empty'=>'Pilih Lulusan Terakhir','class'=>'span5')); 
		?>
	</div>

	<div style="margin-left: -34%; margin-top: 1%;">
	<label class="control-label">Strata</label>
	</div>

	<div style="margin-left: -2%; margin-top: -6%;">
	<?php echo $form->dropDownList($model,'strata_akhir',Personal::listStrata(),array('prompt'=>'Pilih Strata','class'=>'span5'));?>
	</div>
	</div>

	<div id="perguruan2">
	<div style="margin-left: -34%; margin-top: 1%;">
	<label class="control-label">Asal Sekolah</label>
	</div>

	<div style="margin-left: -2%; margin-top: -6%;">
	<?php echo $form->textField($model,'nama_jenjang',array('class'=>'span5','maxlength'=>100,'placeholder'=>'Asal Sekolah')); ?>
	</div>
	</div>

	<div style="margin-left: -34%; margin-top: 1%;">
	<label class="control-label">Jurusan</label>
	</div>

	<div style="margin-left: -2%; margin-top: -6%;">
	<?php echo $form->textField($model,'jurusan',array('class'=>'span5','placeholder'=>'Jurusan'));?>
	</div>

	<div style="margin-left: -34%; margin-top: 1%;">
	<label class="control-label">Status Kepegawaian</label>
	</div>

	<div style="margin-left: -2%; margin-top: -6%;">
	<?php echo $form->dropDownList($model,'status_pegawai',Personal::getStatus(),array('prompt'=>'Pilih Status','class'=>'span5'));?>
	</div>

	<div id="durasi1">
	<div style="margin-left: -34%; margin-top: 1%;">
	<label class="control-label">Periode Kerja</label>
	</div>

	<div style="margin-left: -2%; margin-top: -6%;">
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'name'=>'Personal[durasi_kerja1]',
        'value'=>$model->durasi_kerja1,
        'language'=>'id',
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat'=>'dd MM yy',
                //'changeYear'=>true,
                //'changeMonth'=>true,
                'yearRange'=>'-30',
                'duration'=>'fast',
                'showOn'=>'button',
                //'buttonText'=>Yii::t('ui','Pilih Hari'),
                'buttonImage'=>Yii::app()->request->baseUrl.'/icons/Time-Date-To-icon.png',
                'buttonImageOnly'=>true,
                ),
    ));
?>
	</div>

	<div style="margin-left: -2%; margin-top: 2%;">
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'name'=>'Personal[durasi_kerja2]',
        'value'=>$model->durasi_kerja2,
        'language'=>'id',
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat'=>'dd MM yy',
                'changeYear'=>true,
                'changeMonth'=>true,
                //'yearRange'=>'-30',
                'duration'=>'fast',
                'showOn'=>'button',
                //'buttonText'=>Yii::t('ui','Pilih Hari'),
                'buttonImage'=>Yii::app()->request->baseUrl.'/icons/Time-Date-To-icon.png',
                'buttonImageOnly'=>true,
                ),
    ));
?>
	</div>
    </div>

    <div style="margin-left: -34%; margin-top: 1%;">
	<label class="control-label">Jabatan</label>
	</div>

	<div style="margin-left: -2%; margin-top: -6%;">
	<?php 
	$type_list=CHtml::listData(TblJabatan::model()->findAll(),'id_jabatan','nama_jabatan');
	echo CHtml::activeDropDownList($model,
                                'id_jabatan',
                                $type_list,
                                array('empty'=>'Pilih Jabatan','class'=>'span5')); 
                                ?>
    </div>

	<div style="margin-left: -34%; margin-top: 1%;">
	<label class="control-label">Username <span class="required">*</span></label>
	</div>

	<div style="margin-left: -2%; margin-top: -6%;">
	<?php echo $form->textField($model,'username',array('class'=>'span5','maxlength'=>30,'placeholder'=>'Username')); ?>
	</div>

	<div style="margin-left: -34%; margin-top: 1%;">
	<label class="control-label">Password <span class="required">*</span></label>
	</div>

	<div style="margin-left: -2%; margin-top: -6%;">
	<?php echo $form->passwordField($model,'password',array('class'=>'span5','maxlength'=>100,'placeholder'=>'Password')); ?>
	</div>

	<div style="margin-left: -34%; margin-top: 1%;">
	<label class="control-label">E-mail <span class="required">*</span></label>
	</div>

	<div style="margin-left: -2%; margin-top: -6%;">
	<?php echo $form->textField($model,'email',array('class'=>'span5','maxlength'=>120,'placeholder'=>'E-mail')); ?>
	</div>
<?php $date=date("Y-m-d H:i:s"); echo $form->hiddenField($model,'tgl_data',array('class'=>'span4','value'=>$date)); ?>
<?php echo $form->hiddenField($model,'id_role',array('class'=>'span5')); ?>

<?php if (extension_loaded('gd')): ?>
	<div class="row">
	<br/>
	<div style="margin-left: 2.5%; margin-top: -3%;">
	<?php $this->widget('CCaptcha'); ?>
	</div>
	<div style="margin-left: 4%; margin-top: -1%;">
	<?php echo CHtml::activeTextField($model,'verifyCode',array('placeholder'=>'Tulis kode verifikasi berikut','class'=>'span5')); ?>
	</div>
<?php endif ;?>

	<div style="margin-left: 4.5%; margin-top: 4%;">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'icon'=>'white plus',
			'label'=>$model->isNewRecord ? 'Simpan' : 'Ubah',
		)); ?>
	</div>

</div>
<?php $this->endWidget(); ?>
<?php
Yii::app()->clientScript->registerScript('personal-form-functions', "
$('#Personal_jenis_jenjang').change(function(){
        showHideSignedInput();
});
function showHideSignedInput() {
		 if ($('#Personal_jenis_jenjang').val() == 'Perguruan Tinggi') {
                $('#perguruan').show();
        }
        else if ($('#Personal_jenis_jenjang').val() == 'SMA/SMK' ) {
                $('#perguruan').hide();
        }

}
$('#Personal_status_pegawai').change(function(){
        showHideSignedInput();
});
function showHideSignedInput() {
		 if ($('#Personal_status_pegawai').val() == 'Magang') {
                $('#durasi1').show();
        }
        else if ($('#Personal_status_pegawai').val() == 'Kontrak' ) {
                $('#durasi1').show();
        }else {
                $('#durasi1').hide();
        }

}
showHideSignedInput();
");
?>