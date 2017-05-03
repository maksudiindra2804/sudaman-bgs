<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id_kategori')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_kategori),array('view','id'=>$data->id_kategori)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kategori')); ?>:</b>
	<?php echo CHtml::encode($data->kategori); ?>
	<br />


</div>