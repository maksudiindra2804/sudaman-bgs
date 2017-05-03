<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'data-trainner-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	// 'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Kolom dengan tanda <span class="required">*</span> harus di isi.</p>

	<?php echo $form->errorSummary($model); ?>

<div style="margin-top: 2%; margin-left: 1%;">
<label class="control-label">Kode Trainner <span class="required">*</span>
</div>

<div style="margin-left: 12%; margin-top: -2.2%;">
<?php echo $form->textField($model,'kode_trainner',array('class'=>'span5','maxlength'=>10,'placeholder'=>'Kode harus unik Ex: T005')); ?>
</div>

<div style="margin-top: 1%; margin-left: 1%;">
<label class="control-label">Nama Trainner <span class="required">*</span>
</div>

<div style="margin-left: 12%; margin-top: -2.2%;">
<?php echo $form->textField($model,'nama_trainner',array('class'=>'span5','maxlength'=>100,'placeholder'=>'Nama Lengkap Beserta Gelar')); ?>
</div>

<?php $date=date("Y-m-d H:i:s"); echo $form->hiddenField($model,'tgl_data',array('class'=>'span4','value'=>$date)); ?>


<div class="form-actions">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'icon'=>'white plus',
			'label'=>$model->isNewRecord ? 'Simpan' : 'Ubah',
		)); ?>
</div>

<?php $this->endWidget(); ?>
