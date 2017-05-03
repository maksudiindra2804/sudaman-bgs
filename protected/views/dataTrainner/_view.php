<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('kode_trainner')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->kode_trainner),array('view','id'=>$data->kode_trainner)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_trainner')); ?>:</b>
	<?php echo CHtml::encode($data->nama_trainner); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgl_data')); ?>:</b>
	<?php echo CHtml::encode($data->tgl_data); ?>
	<br />


</div>