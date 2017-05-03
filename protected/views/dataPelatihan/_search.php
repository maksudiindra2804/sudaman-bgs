<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<div style="margin-left: 1%; margin-top: 1%;">
		<label class="control-label">Jenis Pelatihan</label>
		</div>

		<div style="margin-left: 10%; margin-top: -2.2%;">
		<?php echo $form->textField($model,'jenis',array('class'=>'span4','maxlength'=>30,'placeholder'=>'Jenis Pelatihan')); ?>
		</div>
		<div style="margin-left: 41%; margin-top: -3%;">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'icon'=>'white search',
			'label'=>'Cari',
		)); ?>
		</div>


<?php $this->endWidget(); ?>
