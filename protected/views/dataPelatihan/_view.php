<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id_pelatihan')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_pelatihan),array('view','id'=>$data->id_pelatihan)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jenis')); ?>:</b>
	<?php echo CHtml::encode($data->jenis); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgl_data')); ?>:</b>
	<?php echo CHtml::encode($data->tgl_data); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>