<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id_child')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_child),array('view','id'=>$data->id_child)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pelatihan')); ?>:</b>
	<?php echo CHtml::encode($data->id_pelatihan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jenis')); ?>:</b>
	<?php echo CHtml::encode($data->jenis); ?>
	<br />


</div>