<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'data-kompensasi-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Kolom dengan <span class="required">*</span> harus di isi.</p>

	<?php echo $form->errorSummary($model); ?>

<div style="margin-left: 1%; margin-top: 1%;">
<label class="control-label">Pilih Jabatan <span class="required">*</span></label>
</div>

<div style="margin-left: 15%; margin-top: -2%;">
	<?php echo $form->labelEx($model,''); ?>
	<?php
	echo $form->DropDownList($model,'id_jabatan',
		CHtml::listData(TblJabatan::model()->findAll(array('order'=>'nama_jabatan asc')),'id_jabatan','nama_jabatan'),
		array(
			'prompt'=>'Pilih Jabatan',
			'class'=>'span5',
			'ajax' => array(
				'type'=>'POST',
				'url'=>CController::createUrl('DataKompensasi/lookuppegawai'), //selectjur adalah actionSelectjur di ProfilController.
				'update'=>'#'.CHtml::activeId($model,'nip'), //jurusan_id = field jurusan_id
				'beforeSend'=>'function() { 
					$("#DataKompensasi_nip").find("option").remove();
				}',
				//Bila tidak menggunakan ini, maka yg terupdate hanya jurusan (bawaan 'update').
				)
			)
		);
		?>
		<?php echo $form->error($model,'id_jabatan'); ?>
</div>

<div style="margin-left: 1%; margin-top: 1%;">
<label class="control-label">Pilihan NIP <span class="required">*</span></label>
</div>

<div style="margin-left: 15%; margin-top: -2%;">
	<?php echo $form->dropDownList($model,'nip',
		(!$model->isNewRecord) ? $model->lookuppegawai() :array(),
		array(
			'class'=>'span5',
			'prompt'=>'Pilih Pegawai',
			)
			); ?> 

			<?php echo $form->error($model,'nip'); ?>
</div>

<div style="margin-left: 1%; margin-top: 1%;">
<label class="control-label">Data Pelatihan Talenta <span class="required">*</span></label>
</div>

<div style="margin-left: 15%; margin-top: -2%;">
	<?php 
	echo $form->dropDownList($model,'id_talent', 
		CHtml::listData(DataTalent::model()->findAll(array('order'=>'nip asc')),
			'id_talent','nip','status'),
			array('prompt'=>'Pilih Jenis Pelatihan','class'=>'span5')
		);
	;?>
</div>

<div style="margin-left: 1%; margin-top: 1%;">
<label class="control-label">Data Pelatihan Karier <span class="required">*</span></label>
</div>

<div style="margin-left: 15%; margin-top: -2%;">
	<?php 
	echo $form->dropDownList($model,'id_karier', 
		CHtml::listData(DataKarier::model()->findAll(array('order'=>'nip asc')),
			'id_karier','nip','status'),
			array('prompt'=>'Pilih Jenis Pelatihan','class'=>'span5')
		);
	;?>
</div>

<div style="margin-left: 1%; margin-top: 1%;">
<label class="control-label">Data Lembur <span class="required">*</span></label>
</div>

<div style="margin-left: 15%; margin-top: -2%;">
	<?php 
	echo $form->dropDownList($model,'id_absen', 
		CHtml::listData(TblAbsensi::model()->findAll(array('order'=>'nip asc')),
			'id_absen','total_jam','nip','status'),
			array('prompt'=>'Pilih Data Lembur','class'=>'span5')
		);
	;?>
</div>

<div style="margin-left: 1%; margin-top: 1%;">
<label class="control-label">Jenis Kompensasi <span class="required">*</span></label>
</div>

<div style="margin-left: 15%; margin-top: -2%;">
<label class="control-label">Imbalan Ektrinsik & Tunjangan</label>
	<?php
		$x=array('Bonus'=>'Bonus <br>',
			'Upah'=>'Upah <br>',
            'Uang Makan'=>'Uang Makan <br>',
            'Rekreasi'=>'Rekreasi<br>',
            'Biaya Melanjutkan Kuliah'=>'Biaya Melanjutkan Kuliah<br>',
            'Asuransi'=>'Asuransi');
		echo $form->radioButtonList($model,'jenis_reward', $x,array('labelOptions'=>array('style'=>'display:inline'), 'separator'=>'')); ?>

</div>

<div style="margin-left: 1%; margin-top: 1%;">
<label class="control-label">Keterangan Kompensasi</label>
</div>

<div style="margin-left: 15%; margin-top: -2%;">
<?php echo $form->textArea($model,'keterangan_reward',array('rows'=>6, 'cols'=>50, 'class'=>'span6','placeholder'=>'Keterangan Kompensasi')); ?>
</div>

<div style="margin-left: 1%; margin-top: 1%;">
<label class="control-label">Jumlah Kompensasi <span class="required">*</span></label>
</div>

<div style="margin-left: 15%; margin-top: -2%;">
<?php echo $form->textField($model,'jumlah',array('class'=>'span5','maxlength'=>50,'placeholder'=>'Nominal Dalam Rupiah')); ?>
</div>

<?php $date=date("Y-m-d H:i:s"); echo $form->hiddenField($model,'tgl_data',array('class'=>'span4','value'=>$date)); ?>
<?php echo $form->hiddenField($model,'nama_lengkap',array('class'=>'span5','maxlength'=>150)); ?>
<div class="form-actions">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'icon'=>'white plus',
			'label'=>$model->isNewRecord ? 'Simpan' : 'Ubah',
		)); ?>
</div>

<?php $this->endWidget(); ?>
