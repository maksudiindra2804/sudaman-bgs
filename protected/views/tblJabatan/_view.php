<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id_jabatan')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_jabatan),array('view','id'=>$data->id_jabatan)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_jabatan')); ?>:</b>
	<?php echo CHtml::encode($data->nama_jabatan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>