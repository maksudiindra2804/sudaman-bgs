
<?php $user = Yii::app()->getComponent('user');

    $user->setFlash(
    'info',
    
    "<strong><ul><h2><img src='/sudaman_bgs/images/logo.png' width='150' height='50' border='3' alt=''/> &nbsp;PT. Bahana Global Solution <br/><small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TALK WITH US, SHARE WITH US, AND BLEND WITH US FOR THE BRIGHTER FUTURE</small>
</h2></ul>"
);

?>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
    'fade' => true,
    'closeText' => false, // false equals no close link
    'events' => array(),
    'htmlOptions' => array(),
    'userComponentId' => 'user',
    'alerts' => array( // configurations per alert type
        // success, info, warning, error or danger
        'success' => array('closeText' => '&times;'),
        'info', // you don't need to specify full config
        'warning' => array('closeText' => false),
        'error' => array('closeText' => 'AAARGHH!!')
    ),
));?>

<div class="row-fluid">
  <div class="span12">
    <?php
        $this->beginWidget('zii.widgets.CPortlet', array(
            'title'=>"&nbsp;",
        ));
        
    ?>

<img src='/sudaman_bgs/images/banner-crt.png' width='2000' height='400' border='3' alt=''/>

  </div>
   <?php $this->endWidget();?>
</div>




<?php
    $this->beginWidget('zii.widgets.CPortlet', array(
      'title'=>'HRISystem (Human Resources System)',
    ));
    
?>
<p>
HRIS merupakan sistem manajemen Sumber Daya Manusia di PT. Bahana Global Solution, sistem ini mencakup sebagai berikut:<br>
<ol>
  <li>Manajemen Waktu dalam absensi lembur pegawai.</li>
  <li>Manajemen data pegawai. </li>
  <li>Manajemen data pegawai mengenai pengembangan atau pelatihan Talenta.</li>
  <li>Manajemen data pegawai mengenai pengembangan atau pelatihan Karier.</li>
  <li>Manajemen kompensasi untuk pegawai yang berprestasi guna untuk memberikan motivasi kerja sehingga dapat memberikan kontribusi baik secara terus-menerus di dalam perusahaan.</li>
</ol>
<?php 
$this->endWidget();
?>


<?php
    $this->beginWidget('zii.widgets.CPortlet', array(
      'title'=>'HRISystem (Human Resources System)',
    ));
    
?>
<?php 
$this->Widget('ext.highcharts.highcharts.HighchartsWidget', array(
   'options' => array(
      'title' => array('text' => 'Fruit Consumption'),
      'xAxis' => array(
         'categories' => array('Apples', 'Bananas', 'Oranges')
      ),
      'yAxis' => array(
         'title' => array('text' => 'Fruit eaten')
      ),
      'series' => array(
         array('name' => 'Jane', 'data' => array(1, 0, 4)),
         array('name' => 'John', 'data' => array(5, 7, 3))
      )

   )
));?>

<?php 
$this->endWidget();
?>