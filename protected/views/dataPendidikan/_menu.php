<?php
$dapet=@$_GET['id'];
$currController 	= Yii::app()->controller->id;
$currControllers	= explode('/', $currController);
$currAction			= Yii::app()->controller->action->id;
$currRoute 			= Yii::app()->controller->getRoute();
$currRoutes			= explode('/', $currRoute);

$menu=array();
if(in_array($currAction,array('index','view','create','update','admin','calendar','import')))
$menu[]=array('label'=>'Tambah Data','url'=>array('create'),'icon'=>'fa fa-plus-circle','active'=>($currAction=='create')?true:false);

if(in_array($currAction,array('index','view','create','update','admin','calendar','import')))
$menu[]=array('label'=>'Data Riwayat Pendidikan','url'=>array('admin'),'icon'=>'fa fa-tasks','active'=>($currAction=='admin')?true:false);
