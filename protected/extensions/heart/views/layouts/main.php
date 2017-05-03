<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<?php
	$assetsDir=Yii::getPathOfAlias('ext.heart.views.css');
	$assets=Yii::app()->assetManager->publish($assetsDir);
	$cs=Yii::app()->clientScript;
	$cs->registerCssFile($assets.'/main.css');
	?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<?php
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

$menu=array();
require(dirname(__FILE__).DIRECTORY_SEPARATOR.'_menu.php');

$this->widget('bootstrap.widgets.TbNavbar', array(
	'type'=>'inverse', // null or 'inverse'
	'brand'=>CHtml::encode(Yii::app()->name),
	'brandUrl'=>'#',
	'collapse'=>true, // requires bootstrap-responsive.css
	'items'=>array(
		array(
			'class'=> 'bootstrap.widgets.TbMenu',
			'items'=> $menu,				
		),
		array(
			'class'=>'bootstrap.widgets.TbMenu',
			'htmlOptions'=>array('class'=>'pull-right'),
			'items'=>array(
				array('label'=>'Login', 'url'=>array('/site/login'), 'icon'=>'fa fa-unlock', 'visible'=>Yii::app()->user->isGuest),

				//'---',
				array('label'=>'', 'url'=>'#', 'icon'=>'fa fa-user', 'visible'=>!Yii::app()->user->isGuest, 'items'=>array(
					array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('site/logout'), 'icon'=>'fa fa-power-off',),
					array('label'=>'Ubah Password', 'url'=>array('/tblPersonal/changepassword','id'=>$idd),'icon'=>'fa fa-cog'  ,'active'=>($currController=='tblPersonal' and $currAction=='changepassword' ),'visible'=>Yii::app()->user->getLevel()==3),
	
				)),

			),
		),
	),
));
?>

<div class="container" id="page">
	<?php 
	if(isset($this->breadcrumbs)){
		$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
		    'links'=>$this->breadcrumbs,
		));
	}	
	?>
	<?php echo $content; ?>
	<div class="clearfix"></div>
</div><!-- page -->

<?php
$this->widget('bootstrap.widgets.TbNavbar', array(
	'brand' => '<center><small>Copyright &copy; 2017 by Hafid Mukhlasin. All Rights Reserved</small>. <small>SYS-SUDAMAN Bahana Global Solution</small>',
	'fixed' => 'bottom',
	'type' => 'inverse',
));
?>
</body>
</html>
