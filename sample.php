<!DOCTYPE html>
<!-- FILENAME sample.php ver:1.99x -->
<html lang="en-US" dir="ltr">
<head>
	<meta http-equiv="Content-Type; X-UA-Compatible" content="text/html; charset=utf-8; IE=edge" />
</head>
<body>
	<form name="query" method="post" action="">
	
	<hr/>
	<input type="submit" name="proses" value="Proses"/>
	</form>

	<hr/>
	
<?php

require_once "adapter.php";
printScript();

if(isset($_POST['proses'])){

	$url='http://simantra.ntbprov.go.id/mantra/api/diskominfotik_ntbprov/presensi_online/';
	$method='presensi_harian';
	$accesskey='ecvg645gep';
	$request=isset($_POST["par"])?$_POST["par"]:array();

	$table=callAPI(
		$endpoint=$url,
		$operation=$method,
		$accesskey,
		$parameter=$request,
		$callmethod='POST' // call option: GET, POST, REST, RESTFULL, RESTFULLPAR
	);
	
	if(isset($table['response']['data'][$method])) view_table($table['response'],$method);		

	echo "<hr/>";	
	
	$xml=setArray2XML('response',$table['response']); 
	echo "Uraian data xml:<br/>";
	echo "<pre>".htmlentities($xml,ENT_QUOTES)."</pre><hr/>";
	echo "Uraian data array:<br/><pre>";
	echo var_export($table,true); 
	echo "</pre><br/><hr/>";
	echo "Uraian data json:<br/><pre>";
	echo stripslashes(json_encode($table,JSON_PRETTY_PRINT | JSON_FORCE_OBJECT | JSON_PARTIAL_OUTPUT_ON_ERROR));
	echo "</pre><br/><hr/>";	
}

?>

</body>
</html>
