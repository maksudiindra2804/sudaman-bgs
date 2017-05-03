<?php
$currController 	= Yii::app()->controller->id;
$currControllers	= explode('/', $currController);
$currAction			= Yii::app()->controller->action->id;
$currRoute 			= Yii::app()->controller->getRoute();
$currRoutes			= explode('/', $currRoute);

$menu=array();
if(in_array($currAction,array('index','view','create','update','admin','calendar','import')))
$menu[]=array('label'=>'Tambah Data Pegawai','url'=>array('create'),'icon'=>'fa fa-plus-circle','active'=>($currAction=='create')?true:false);

if(in_array($currAction,array('index','view','create','update','admin','calendar','import')))
$menu[]=array('label'=>'Cetak Laporan','url'=>array('index'),'icon'=>'fa fa-print','active'=>($currAction=='index')?true:false);

if(in_array($currAction,array('index','view','create','update','admin','calendar','import')))
$menu[]=array('label'=>'Data Pegawai','url'=>array('admin'),'icon'=>'fa fa-group','active'=>($currAction=='admin')?true:false);
