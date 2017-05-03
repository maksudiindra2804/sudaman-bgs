<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'tbl-absensi-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	// 'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Kolom dengan tanda <span class="required">*</span> tidak boleh kosong.</p>

	<?php echo $form->errorSummary($model); ?>
	<br>
	<div style="margin-left:10%; margin-top:5%;">
	<label class="control-label">NIP Anda <span class="required">*</span></label>
	</div>
	
	<div style="margin-left:19%; margin-top:-2.5%;">
	<?php echo $form->textField($model,'nip',array('class'=>'span5','maxlength'=>50,'placeholder'=>'NIP Pegawai','minLength'=>5));?>
	<!--,'value'=>Yii::app()->user->getId(),'readOnly'=>true)); ?>-->
	</div>

	<?php $date=date("Y-m-d H:i:s"); echo $form->hiddenField($model,'absen_datang',array('class'=>'span4','value'=>$date)); ?>
<?php echo $form->hiddenField($model,'status',array('class'=>'span5','maxlength'=>100)); ?>

<div style="margin-left: 65%; margin-top: -15%;">
<div style="text-align:center;width:400px;padding:1em 0;"> <h2><a style="text-decoration:none;" href="http://www.zeitverschiebung.net/en/timezone/asia--jakarta"><span style="color:gray;"></span><br />Bandung, Jawa Barat</a></h2> <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=en&timezone=Asia%2FJakarta" width=100%" height="150" frameborder="0" seamless></iframe></div>
</div>

<div style="margin-top: -5%; margin-left: 19.1%;">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'icon'=>'white plus',
			'label'=>$model->isNewRecord ? 'Simpan' : 'Simpan',
		)); ?>

</div>
<br>
<?php $this->endWidget(); ?>
