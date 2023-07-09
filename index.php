<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">  
        <meta name="description" content="Mikrotik API ON/OFF PHP">
        <meta name="keywords" content="HTML, PHP, Mikrotik">
        <meta name="author" content="Andrzej Bednarczyk">
		<link href="index.css" rel="stylesheet">   	
        <title>Mikrotik API</title>
    </head>
    <body>
	</body>
</html>
<?php
require_once('./routeros_api.class.php');

function read_mikrotik($komentarz) {
    if (!empty($komentarz) && isset($komentarz)) {	
        $API = new RouterosAPI();
        $API->debug = false;
        if ($API->connect('192.168.1.1', 'user_git', 'P@$$w0rd')) {
            $API->write('/ip/firewall/filter/print',false);
            $API->write('?comment='.$komentarz,true);
            $READ = $API->read(false);
            $MARRAY = $API->parseResponse($READ);
            $state = $MARRAY[0]['disabled']=='true' ? "<span style='color:green;font-weight:bold;'>Włączony</span>" : "<span style='color:red;font-weight:bold;'>Wyłączony</span>";
            $API->disconnect();
        }
	return $state;
    }
}

$array = array(
    "1" => "TV",
    "2" => "Tablet",
    "3" => "Telefon",
);

foreach ($array as $value) {
    echo "<span style='font-weight:bold;'>".$value."</span> ".read_mikrotik($value)."<br><br>";
    echo "<a href='stan.php?stan=yes&amp;komentarz=".$value."' class='myButtonON'>Włącz</a>&nbsp;&nbsp;&nbsp;<a href='stan.php?stan=no&amp;komentarz=".$value."' class='myButtonOFF'>Wyłącz</a>";
    echo "<br><br>";
} 
?>