<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
		
		<div style="margin-left: 1%; margin-top: 1%;">
		<label class="control-label">NIP</label>
		</div>

		<div style="margin-left: 10%; margin-top: -2.2%;">
		<?php echo $form->textField($model,'nip',array('class'=>'span4','maxlength'=>30,'placeholder'=>'NIP Pegawai')); ?>
		</div>

		<div style="margin-left: 1%; margin-top: 1%;">
		<label class="control-label">Nama Pegawai</label>
		</div>

		<div style="margin-left: 10%; margin-top: -2.2%;">
		<?php echo $form->textField($model,'nama_lengkap',array('class'=>'span4','maxlength'=>100,'placeholder'=>'Nama Pegawai')); ?>
		</div>

		<div style="margin-left: 10%; margin-top: 1%;">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'icon'=>'fa fa-search',
			'label'=>'Cari',
		)); ?>
		</div>

<?php $this->endWidget(); ?>
