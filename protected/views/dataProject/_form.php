<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'data-project-form',
	'enableAjaxValidation'=>false,
	// 'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Data dengan tanda <span class="required">*</span> harus di isi.</p>

	<?php echo $form->errorSummary($model); ?>

	<div style="margin-left: 3%; margin-top: 3%;">
	<label class="control-label">NIP Anda <span class="required">*</span></label>
	</div>

	<div style="margin-left: 10%; margin-top: -2.2%;">
	<?php echo $form->textField($model,'nip',array('class'=>'span5','placeholder'=>'NIP','minLength'=>5));?>
	</div>

		<div style="width: 1235px;">
	    <?php $this->widget('application.extensions.appendo.JAppendo',array(
        	'id' => 'repeateEnum',        
        	'model' => $model,
        	'viewName' => 'project',
        	'labelDel' => 'Hapus Kolom',
       		// 'cssFile' => 'css/jquery.appendo2.css'
    	)); ?>
    	</div>

<div class="form-actions">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'icon'=>'white plus',
			'label'=>$model->isNewRecord ? 'Simpan' : 'Ubah',
		)); ?>
</div>

<?php $this->endWidget(); ?>
