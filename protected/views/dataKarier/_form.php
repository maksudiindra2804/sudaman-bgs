<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'data-karier-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	// 'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Kolom dengan tanda <span class="required">*</span> harus di isi.</p>

	<?php echo $form->errorSummary($model); ?>

<div style="margin-left: 1%; margin-top: 1%;">
<label class="control-label">Mapping Kompentensi <span class="required">*</span></label>
</div>

<div style="margin-left: 15%; margin-top: -2%;">
	<?php 
	echo $form->dropDownList($model,'id_mapping', 
		CHtml::listData(MappingKarier::model()->findAll(array('order'=>'mapping asc')),
			'id_mapping','child_mapping','mapping'),
			array('prompt'=>'Pilih Mapping Kompentensi','class'=>'span5')
		);
	;?>
</div>

<div style="margin-left: 1%; margin-top: 1%;">
<label class="control-label">Jabatan <span class="required">*</span></label>
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
				'url'=>CController::createUrl('DataKarier/lookuppegawai'), //selectjur adalah actionSelectjur di ProfilController.
				'update'=>'#'.CHtml::activeId($model,'nip'), //jurusan_id = field jurusan_id
				'beforeSend'=>'function() { 
					$("#DataKarier_nip").find("option").remove();
					$("#DataTalent_nama_lengkap").find("option").remove();
				}',
				//Bila tidak menggunakan ini, maka yg terupdate hanya jurusan (bawaan 'update').
				)
			)
		);
		?>
		<?php echo $form->error($model,'id_jabatan'); ?>
</div>

<div style="margin-left: 1%; margin-top: 1%;">
<label class="control-label">NIP Pegawai <span class="required">*</span></label>
</div>

<div style="margin-left: 15%; margin-top: -2%;">
	<?php echo $form->labelEx($model,''); ?>
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
<label class="control-label">Tanggal Pelatihan <span class="required">*</span></label>
</div>

<div style="margin-left: 15%; margin-top: -2%;">
	<?php $this->widget('ext.YiiDateTimePicker.jqueryDateTime', array(
        'model' => $model,
        'attribute' => 'tgl_pelatihan',
        'options' => array(), //DateTimePicker options
        'htmlOptions' => array('class'=>'span5','placeholder'=>'Atur Tanggal & Waktu'),
    ));
	?>
</div>

<div style="margin-left: 1%; margin-top: 1%;">
<label class="control-label">Status Pelatihan <span class="required">*</span></label>
</div>

<div style="margin-left: 15%; margin-top: -2%;">
<?php echo $form->dropDownList($model,'status', DataKarier::getStatus(),array('prompt'=>'Pilih Status','class'=>'span5'));?>
</div>

<div style="margin-left: 1%; margin-top: 1%;">
<label class="control-label">Deskripsi Pelatihan <span class="required">*</span></label>
</div>

<div style="margin-left: 15%; margin-top: -2%;">
<?php echo $form->textArea($model,'keterangan',array('rows'=>6, 'cols'=>50, 'class'=>'span7','placeholder'=>'Deksripsi Mengenai Pelatihan Karier Pegawai')); ?>
</div>

<div style="margin-left: 1%; margin-top: 1%;">
<label class="control-label">Keterangan Pelatihan</label>
</div>

<div style="margin-left: 15%; margin-top: -2%;">
<?php echo $form->textArea($model,'deskripsi',array('rows'=>6, 'cols'=>50, 'class'=>'span7','placeholder'=>'Sisipkan Tempat Pelaksanaan')); ?>
</div>

<?php $date=date("Y-m-d H:i:s"); echo $form->hiddenField($model,'tgl_data',array('class'=>'span4','value'=>$date)); ?>
<?php echo $form->hiddenField($model,'nama_lengkap',array('class'=>'span5','maxlength'=>150)); ?>

<div class="form-actions">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'icon'=>'white plus',
			'label'=>$model->isNewRecord ? 'Simpan' : 'Ubah',
		)); ?>
</div>

<?php $this->endWidget(); ?>
