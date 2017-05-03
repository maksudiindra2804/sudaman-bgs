<?php

$menu=array();
require(dirname(__FILE__).DIRECTORY_SEPARATOR.'_menu.php');


$menu2=array(
	array('label'=>'Menu','url'=>array('index'),'icon'=>'fa fa-list-alt', 'items' => $menu)	
);

if(!isset($_GET['asModal'])){
?>
<?php $box = $this->beginWidget(
    'bootstrap.widgets.TbBox',
    array(
        'title' => 'Data Riwayat Pegawai',
        'headerIcon' => 'icon- fa fa-eye',
        'headerButtons' => array(
            array(
                'class' => 'bootstrap.widgets.TbButtonGroup',
                'type' => 'success',
                // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'buttons' => $menu2
            ),
        ) 
    )
);?>
<?php
}
?>

		<?php $this->widget('bootstrap.widgets.TbAlert', array(
		    'block'=>false, // display a larger alert block?
		    'fade'=>true, // use transitions?
		    'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
		    'alerts'=>array( // configurations per alert type
		        'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), //success, info, warning, error or danger
		        'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), //success, info, warning, error or danger
		        'warning'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), //success, info, warning, error or danger
		        'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), //success, info, warning, error or danger
		        'danger'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), //success, info, warning, error or danger
		    ),
		));
		?>		
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(

		array(
			'label'=>'NIP',
			'name'=>'nip',
			'value'=>$model->nip,
		),

		array(
			'label'=>'Tahun Ke-1',
			'name'=>'tahun1',
			'value'=>$model->tahun1,
		),

		array(
			'label'=>'Tahun Ke-2',
			'name'=>'tahun2',
			'value'=>$model->tahun2,
		),

		array(
			'label'=>'Riwayat',
			'name'=>'riwayat',
			'value'=>$model->riwayat,
		),
	),
)); ?>

<?php
if(!isset($_GET['asModal'])){
	$this->endWidget();}
?>