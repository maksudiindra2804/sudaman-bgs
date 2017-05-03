<?php


if(!isset($_GET['asModal'])){
?>
<?php $box = $this->beginWidget(
    'bootstrap.widgets.TbBox',
    array(
        'title' => 'Data Absensi Lembur',
        'headerIcon' => 'icon- fa fa-clock-o',
        'headerButtons' => array(
            array(
                'class' => 'bootstrap.widgets.TbButtonGroup',
                'type' => 'success',
                // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
          //      'buttons' => '',
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

<?php

// membuat koneksi dengan database//pagging
function keyWord ($string)
{
    $result = strip_tags(str_replace('<p> </p>', ' ', $string));
    
    return $result;
}


function getNama($str)
{
$kalimat=explode(" ",trim($str));
$arr_length = count($kalimat);


if  ($arr_length > 0){
   $output = $kalimat[$arr_length-1];
   if($arr_length>1){
       $output.=', ';
   }
    for($x = 0; $x<=$arr_length-2; $x++){
        if($kalimat[$x]<>""){
        $ambilkanan=substr($kalimat[$x],0,1).'. '; 
        $output .= $ambilkanan;
    }
    }
}
        return substr($output,0,-1);;
}


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


$no=0;
$idRegis=Yii::app()->user->getId();
$dapet=@$_GET['id'];
$connection=new CDbConnection('mysql:host=localhost;dbname=sudamandb','root','');
$connection->active=true; // open connection
    $idd=Yii::app()->user->getId();
    
    $que="SELECT a.`id_absen` , a.`nik` , a.`absen_time` , a.`status` , a.`keterangan` , a.`pulang_time` , a.`total_jam`
          FROM tbl_absensi a
          WHERE a.`nik`='$idRegis'";
    $reader=new CSqlDataProvider($que,array(
        'keyField' => 'id',
        //'totalItemCount'=>TblAbsensi::model()->count(),
        'pagination'=>array(
            'pageSize'=>8,
            ),
        ));
    $page = new CPagination(TblAbsensi::model()->count());
    $page->pageSize = 8;
    $command=$connection->createCommand($que);
    $reader=$command->query();   
?>
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">
    <center>
    <div class="table-responsive">
<table class="table table-striped">
  <thead>
  
            <tr>
                <th><center>#</center></th>
                <th><center>NIK</center></th>
                <th><center>Waktu Absen</center></th>
                <th><center>Status</center></th>
                <th><center>Jam Pulang</center></th>
                <th><center>Keterangan</center></th>
                <th><center>Total Lembur</center></th>
               
            </tr>
        </thead>
        <tbody>

              <?php
                foreach($reader as $row){
                    ?>
            <tr>
                <td><?php echo $no=$no+1?></td>
                <td><?php echo $row['nik'];?></td>
                <td><?php echo $row['absen_time'];?></td>
                <td><?php echo $row['status'];?></td>
                <td><?php echo $row['pulang_time'];?></td>
                <td><?php echo $row['keterangan'];?></td>
                <td><?php echo $row['total_jam'];?></td>
  
            </tr>

        </tbody>
            <?php
                }$this->widget('CLinkPager',array('pages'=>$page));
            ?>

    </table>
    </div>

<?php
if(!isset($_GET['asModal'])){
    $this->endWidget();}
?>
