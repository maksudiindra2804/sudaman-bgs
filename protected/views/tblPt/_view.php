<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id_pt')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_pt),array('view','id'=>$data->id_pt)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_pt')); ?>:</b>
	<?php echo CHtml::encode($data->kode_pt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_pt')); ?>:</b>
	<?php echo CHtml::encode($data->nama_pt); ?>
	<br />


</div>