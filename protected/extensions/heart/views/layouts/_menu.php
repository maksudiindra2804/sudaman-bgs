<?php
$currController 	= Yii::app()->controller->id;
$currControllers	= explode('/', $currController);
$currAction			= Yii::app()->controller->action->id;
$currRoute 			= Yii::app()->controller->getRoute();
$currRoutes			= explode('/', $currRoute);
   
  
  $dapet=@$_GET['id'];
  $idd=Yii::app()->user->getId();
  $host = 'localhost';
  $user = 'root';      
  $password = '';      
  $database = 'sudamandb';  
    
  $konek_db = mysql_connect($host, $user, $password);    
  $find_db = mysql_select_db($database) ;
  $query="SELECT nik FROM tbl_personal WHERE nik='$dapet' or nik='$idd'";
 // print_r($query);exit();
  $hasil=mysql_query ($query);

  $dapet2=@$_GET['id'];
  $idget=Yii::app()->user->getId();
  $host2 = 'localhost';
  $user2 = 'root';      
  $password2 = '';      
  $database2 = 'sudamandb'; 

  $konek_db2 = mysql_connect($host2, $user2, $password2);    
  $find_db2 = mysql_select_db($database2) ;

  $dapet2=@$_GET['id'];
  $query2="SELECT nik FROM tbl_absensi WHERE nik='$idget' or nik'$dapet2'";
 // print_r($query);exit();
  $hasil2=mysql_query ($query2);
$menu=
	array(

		//Public
		array('label'=>'Dashboard', 'url'=>array('/site/index'), 'icon'=>'fa fa-dashboard','active'=>($currController=='site' and $currAction=='index' )),
		array('label'=>'Registrasi', 'url'=>array('/tblPersonal/createuser'), 'icon'=>'fa fa-plus', 'visible'=>Yii::app()->user->isGuest),
		
		//For User
		array('label'=>'Biodata Diri  ', 'url'=>array('/tblPersonal/viewuser','id'=>$idd), 'icon'=>'fa fa-group', 'visible'=>Yii::app()->user->getLevel()==3),
		//array('label'=>'Data Talenta  ', 'url'=>array('/tblPersonal/profile'), 'icon'=>'fa fa-trophy', 'visible'=>Yii::app()->user->getLevel()==3),
		
		array('label'=>'Absensi Lembur', 'url'=>'#','visible'=>Yii::app()->user->getLevel()==3, 'icon'=>'fa fa-clock-o' , 'active'=>($currController=='site' and $currAction!='index') , 'items'=>array(
			array('label'=>'Absensi Lembur  ', 'url'=>array('/tblAbsensi/create'), 'icon'=>'fa fa-pencil', 'visible'=>Yii::app()->user->getLevel()==3),
			array('label'=>'Lihat Data Absensi Lembur', 'url'=>array('/tblAbsensi/viewabsuser','id'=>$idget),'icon'=>'fa fa-eye'  ,'active'=>($currController=='site' and $currAction=='contact' ),'visible'=>Yii::app()->user->getLevel()==3),
			//array('label'=>'Absen Kepulangan', 'url'=>array('/tblAbsensi/updateback','id'=>$idd),'icon'=>'fa fa-reload'  ,'active'=>($currController=='site' and $currAction=='contact' ),'visible'=>Yii::app()->user->getLevel()==3),
			//'---',
			//array('label'=>'NAV HEADER'),
		)),
		//For Administrator
		array('label'=>'Menu Data Pegawai', 'url'=>'#','visible'=>Yii::app()->user->getLevel()==1, 'icon'=>'fa fa-group' , 'active'=>($currController=='site' and $currAction!='index') , 'items'=>array(
			array('label'=>'Data Pegawai', 'url'=>array('/tblPersonal/admin'),'icon'=>'fa fa-book'  ,'active'=>($currController=='site' and $currAction=='contact' ),'visible'=>Yii::app()->user->getLevel()==1),


			//'---',
			//array('label'=>'NAV HEADER'),
		)),

		array('label'=>'Menu Absensi Pegawai', 'url'=>'#','visible'=>Yii::app()->user->getLevel()==1, 'icon'=>'fa fa-clock-o' , 'active'=>($currController=='site' and $currAction!='index') , 'items'=>array(
			array('label'=>'Data Absensi', 'url'=>array('/tblAbsensi/admin'),'icon'=>'fa fa-check-circle'  ,'active'=>($currController=='site' and $currAction=='page' ),'visible'=>Yii::app()->user->getLevel()==1),
			array('label'=>'Cetak Laporan', 'url'=>array('/tblAbsensi/index'),'icon'=>'fa fa-print'  ,'active'=>($currController=='site' and $currAction=='contact' ),'visible'=>Yii::app()->user->getLevel()==1),
			//'---',
			//array('label'=>'NAV HEADER'),
		)),

		array('label'=>'Menu Talenta Pegawai', 'url'=>'#','visible'=>Yii::app()->user->getLevel()==1, 'icon'=>'fa fa-flag-checkered' , 'active'=>($currController=='site' and $currAction!='index') , 'items'=>array(
			array('label'=>'Data Pelatihan', 'url'=>array('/tblAbsensi/admin'),'icon'=>'fa fa-trophy'  ,'active'=>($currController=='site' and $currAction=='page' ),'visible'=>Yii::app()->user->getLevel()==1),
			array('label'=>'Cetak Data Pelatihan', 'url'=>array('/tblAbsensi/index'),'icon'=>'fa fa-print'  ,'active'=>($currController=='site' and $currAction=='contact' ),'visible'=>Yii::app()->user->getLevel()==1),
			//'---',
			//array('label'=>'NAV HEADER'),
		)),

		//For Owner or Manager

		
	);	
?>	