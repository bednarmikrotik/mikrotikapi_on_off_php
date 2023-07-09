<?php
require('./routeros_api.class.php');
header( "refresh:1;url=index.php" );
$stan = isset($_GET['stan']) && !empty($_GET['stan']) ? $_GET['stan'] : "no";
$komentarz = isset($_GET['komentarz']) && !empty($_GET['komentarz']) ? $_GET['komentarz'] : "TV";

$API = new RouterosAPI();
$API->debug = false;
if ($API->connect('192.168.1.1', 'user_git', 'P@$$w0rd')) {
	$API->write('/ip/firewall/filter/print',false);
	$API->write('?comment='.$komentarz,true);
	$READ = $API->read(false);
	$ARRAY = $API->parseResponse($READ);
	if(count($ARRAY)>0){
		$API->write('/ip/firewall/filter/set',false);
		$API->write("=.id=".$ARRAY[0]['.id'],false);
		$API->write('=disabled='.$stan,true);
		$READ = $API->read(false);
		$ARRAY = $API->parseResponse($READ);
	}	
}
$API->disconnect();
header("Location: index.php");
exit();
?>