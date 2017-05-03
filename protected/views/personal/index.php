<?php
function indonesian_date ($timestamp = '', $date_format = 'j F Y') {
    if (trim ($timestamp) == '')
    {
            $timestamp = time ();
    }
    elseif (!ctype_digit ($timestamp))
    {
        $timestamp = strtotime ($timestamp);
    }
    # remove S (st,nd,rd,th) there are no such things in indonesia :p
    $date_format = preg_replace ("/S/", "", $date_format);
    $pattern = array (
        '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
        '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
        '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
        '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
        '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
        '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
        '/April/','/June/','/July/','/August/','/September/','/October/',
        '/November/','/December/',
    );
    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
        'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
        'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
        'Januari','Februari','Maret','April','Juni','Juli','Agustus','September',
        'Oktober','November','Desember',
    );
    $date = date ($date_format, $timestamp);
    $date = preg_replace ($pattern, $replace, $date);
    $date = "{$date}";
    return $date;
} 
;?>
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
		$.fn.yiiGridView.update('personal-grid', {
			data: $(this).serialize()
		});
		return false;
	});
");

Yii::app()->clientScript->registerScript('refreshGridView', "
	// automatically refresh grid on 5 seconds
	//setInterval(\"$.fn.yiiGridView.update('personal-grid')\",5000);
");

?>

<?php $box = $this->beginWidget(
    'bootstrap.widgets.TbBox',
    array(
        'title' => 'Cetak Laporan' ,
        'headerIcon' => 'icon- fa fa-list-ol',
        'headerButtons' => array(
            array(
                'class' => 'bootstrap.widgets.TbButtonGroup',
                'type' => 'success',
                // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'buttons' => $this->menu
            ),
        ) 
    )
);?>
<?php /** $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); **/ ?>
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

<?php echo CHtml::link('Cari','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php echo CHtml::beginForm(array('export')); ?>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'personal-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'type' => 'hover bordered', //bordered condensed
	'columns'=>array(
		array(
			'header'=>'NIP',
	        'name'=> 'nip',
	        'value' => '($data->nip)',
	        'headerHtmlOptions' => array('style' => 'text-align:center;'),
	    ),
		
		array(
			'header'=>'Nama Lengkap',
	        'name'=> 'nama_lengkap',
	        'value' => '($data->nama_lengkap)',
	        'headerHtmlOptions' => array('style' => 'text-align:center;'),
	    ),
		
		array(
			'header'=>'Agama',
	        'name'=> 'agama',
	        'value' => '($data->agama)',
	        'headerHtmlOptions' => array('style' => 'text-align:center;'),
	    ),
		
		array(
	        'header' => 'Tempat, Tanggal Lahir',
	        'name'=> 'tgl_lahir',
	        'type'=>'raw',
	        'value' => '($data->tempat_lahir.\', \'.indonesian_date($data->tgl_lahir))',
	        'headerHtmlOptions' => array('style' => 'width:100px;text-align:center;'),
	    ),
		array(
		        'header' => 'Jenis Kelamin',
		        'name'=> 'jenkel',
		        'type'=>'raw',
		        'value' => '($data->jenkel)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),

			array(
		        'header' => 'No. Telepon',
		        'name'=> 'no_telp',
		        'type'=>'raw',
		        'value' => '($data->no_telp)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),

			array(
		        'header' => 'Jabatan',
		        'name'=> 'id_jabatan',
		        'type'=>'raw',
		        'value' => '($data->idJabatan->nama_jabatan)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),

		    ),

			array(
		        'header' => 'Status Pegawai',
		        'name'=> 'status_pegawai',
		        'type'=>'raw',
		        'value' => '($data->status_pegawai)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),

			array(
		        'header' => 'Masa Kerja',
		        'name'=> 'durasi_kerja',
		        'type'=>'raw',
		        'value' => '($data->durasi_kerja)',
	            'headerHtmlOptions' => array('style' => 'text-align:center'),
		    ),

		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{view}',
			'buttons'=>array
            (
                'view' => array
                (    
                	'url' => '$data->nip."|".$data->nip',              
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
	<option value="Excel5">EXCEL 5 (xls)</option>
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
