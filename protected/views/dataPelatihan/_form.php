<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'data-pelatihan-form',
	'enableAjaxValidation'=>false,
	// 'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Kolom dengan tanda <span class="required">*</span> harus di isi.</p>

	<?php echo $form->errorSummary($model); ?>

<div style="margin-top: 2%; margin-left: 1%;">
<label class="control-label">Jenis Pelatihan <span class="required">*</span>
</div>

<div style="margin-left: 12%; margin-top: -2.2%;">
<?php echo $form->textField($model,'jenis',array('class'=>'span5','maxlength'=>100,'placeholder'=>'Jenis Pelatihan')); ?>
</div>

<div style="margin-top: 2%; margin-left: 1%;">
<label class="control-label">Status Pelathihan <span class="required">*</span>
</div>

<div style="margin-left: 12%; margin-top: -2.2%;">
<?php echo $form->dropDownList($model,'status',DataPelatihan::listStatus(),array('prompt'=>'Pilih Status Pelatihan','class'=>'span5'));?>
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
