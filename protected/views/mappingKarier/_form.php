<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'mapping-karier-form',
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
<label class="control-label">Pilih Jabatan <span class="required">*</span></label>
</div>

<div style="margin-left: 14%; margin-top: -2%;">
	<?php 
	echo $form->dropDownList($model,'id_jabatan', 
		CHtml::listData(TblJabatan::model()->findAll(array('order'=>'nama_jabatan asc')),
			'id_jabatan','nama_jabatan'),
			array('prompt'=>'Pilih Jabatan','class'=>'span5')
		);
	;?>
</div>

<div style="margin-left: 1%; margin-top: 1%;">
<label class="control-label">Mapping Kompetensi <span class="required">*</span></label>
</div>

<div style="margin-left: 14%; margin-top: -2%;">
<?php echo $form->textField($model,'mapping',array('class'=>'span5','maxlength'=>200,'placeholder'=>'Mapping Kompetensi')); ?>
</div>

<div style="margin-left: 1%; margin-top: 1%;">
<label class="control-label">Detail Kompetensi <span class="required">*</span></label>
</div>

<div style="margin-left: 14%; margin-top: -2%;">
<?php echo $form->textField($model,'child_mapping',array('class'=>'span5','maxlength'=>200,'placeholder'=>'Detail Kompetensi')); ?>
</div>

<?php $date=date("Y-m-d H:i:s"); echo $form->hiddenField($model,'tgl_data',array('class'=>'span4','value'=>$date)); ?>

<div class="form-actions">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'icon'=>'white plus',
			'label'=>$model->isNewRecord ? 'Simpan' : 'Ubah',
		)); ?>
</div>

<?php $this->endWidget(); ?>
