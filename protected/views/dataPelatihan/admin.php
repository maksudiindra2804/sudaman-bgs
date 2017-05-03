<?php

$menu=array();
require(dirname(__FILE__).DIRECTORY_SEPARATOR.'_menu.php');
$this->menu=array(
	array('label'=>'Menu','url'=>array('index'),'icon'=>'fa fa-list-alt', 'items' => $menu)	
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#data-pelatihan-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $box = $this->beginWidget(
    'bootstrap.widgets.TbBox',
    array(
        'title' => 'Data Pelatihan',
        'headerIcon' => 'icon- fa fa-tasks',
        'headerButtons' => array(
            array(
                'class' => 'bootstrap.widgets.TbButtonGroup',
                'type' => 'success',
                // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'buttons' => $this->menu
            ),
        ) 
    )
);?>		<?php $this->widget('bootstrap.widgets.TbAlert', array(
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

<?php echo CHtml::link('Cari','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php echo CHtml::beginForm(array('export')); ?>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'data-pelatihan-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type' => 'striped hover', //bordered condensed
	'columns'=>array(
			
			array(
		        'header' => 'Jenis Pelatihan',
		        'name'=> 'jenis',
		        'type'=>'raw',
		        'value' => '($data->jenis)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),

			array(
		        'header' => 'Tanggal Data',
		        'name'=> 'tgl_data',
		        'type'=>'raw',
		        'value' => '($data->tgl_data)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),
			
			array(
		        'header' => 'Status Pelatihan',
		        'name'=> 'status',
		        'type'=>'raw',
		        'value' => '($data->status)',
	            'class' => 'bootstrap.widgets.TbEditableColumn',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
	            'editable' => array(
					'type'    => 'select2',
					'url'     => $this->createUrl('editable'),
					'source' => array('Aktif'=>'Aktif', 'Non Aktif'=>'Non Aktif'),
					'params' => array('YII_CSRF_TOKEN' => Yii::app()->request->csrfToken),
				)
		    ),
				
	    array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'buttons'=>array
            (
                'view' => array
                (    
                	'url' => '$data->id_pelatihan."|".$data->jenis',              
                	'click' => 'function(){
                		data=$(this).attr("href").split("|")
                		$("#myModalHeader").html(data[1]);
	        			$("#myModalBody").load("'.$this->createUrl('view').'&id="+data[0]+"&asModal=true");
                		$("#myModal").modal();
                		return false;
                	}', 
                ),
            )
		),
	),
)); ?>

<select name="fileType" style="width:150px;">
	<option value="Excel5">EXCEL (xls)</option>
	<option value="PDF">PDF</option>
	<option value="WORD">WORD (docx)</option>
</select>
<br>

<?php 
$this->widget('bootstrap.widgets.TbButton', array(
	'buttonType'=>'submit', 'icon'=>'fa fa-print','label'=>'Export', 'type'=> 'primary'));
?>
<?php echo CHtml::endForm(); ?>
<?php $this->endWidget(); ?>
<?php  $this->beginWidget(
    'bootstrap.widgets.TbModal',
    array('id' => 'myModal')
); ?>
 
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4 id="myModalHeader">Modal header</h4>
    </div>
 
    <div class="modal-body" id="myModalBody">
        <p>Data Kosong</p>
    </div>
 
    <div class="modal-footer">
        <?php  $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'label' => 'Keluar',
                'url' => '#',
                'htmlOptions' => array('data-dismiss' => 'modal'),
            )
        ); ?>
    </div>
 
<?php  $this->endWidget(); ?>
