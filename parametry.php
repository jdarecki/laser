<?php

/**
 * Definicja stałych.
 */

define('ADRES_STRONY', 'http://laser.nextserv.pl');
define('NAZWA','Laser');
define('LOGINSITE','ps/login.php');

define('SER', 'localhost');
define('UZY', '02730806_laser');
define('HAS', '1@Wertyui6645460');
define('BAZ', '02730806_laser');



/**
 * Definicja funkcji
 */


function pasek2($rekordow,$na_stronie,$na_pasku,$skrypt,$s,$size) {
  $stron = ceil($rekordow/$na_stronie);
  if ($s<1) $s=1;
  if ($s>$stron) $s=$stron;
  $koniec = $s+$na_pasku;
  if ($s<=$na_pasku) $koniec = $na_pasku*2+1;
  if ($koniec>$stron) $koniec = $stron;
  $start = $koniec-$na_pasku*2;
  if ($start<1) $start=1;
  if ($s>1) $p = "<li><a href=\"$skrypt".($s-1)."\"> &laquo; </a></li>";
  else $p = "<li><a href=\"#\">&laquo;</a></li>";
  if ($s<$stron) $n = "<li><a href=\"$skrypt".($s+1)."\"> &raquo; </a></li>";
  else $n = "<li><a href=\"#\">&raquo;</a></li>";
  for ($i=$start; $i<=$koniec; $i++) {
    if ($i==$s) $l .= "<li class=\"active\"><a href=\"#\">".$i."</a></li>";
    else $l .= "<li><a href=\"".$skrypt.$i."\">$i</a></li>";
  }
  if ($rekordow<1) $napis = "";
  else $napis = "";
  if ($stron>1) $wynik .= "<nav aria-label=\"Page navigation\"><ul class=\"pagination ".$size."\">".$p.$l.$n."</ul></nav>";
  return $wynik;
}

function blink($zmienna) {
	$trans=array("ą"=>"a","ć"=>"c","ę"=>"e","ł"=>"l","ń"=>"n","ś"=>"s","ó"=>"o","ź"=>"z","ż"=>"z"," "=>"-",
	             "Ą"=>"a","Ć"=>"c","Ę"=>"e","Ł"=>"l","Ń"=>"n","Ś"=>"s","Ó"=>"o","Ź"=>"z","Ż"=>"z");
	$wyniktmp=strtr(strtolower(trim($zmienna)),$trans);
	$wynik="";	
	for ($i=0;$i<strlen($wyniktmp);$i++) {
		if(preg_match('/^[a-zA-Z0-9\-]*$/D',$wyniktmp[$i])) {
			$wynik=$wynik.$wyniktmp[$i];
		}
	}
	return $wynik;
}

// Przykład połączenia z bazą danych - clasa mysqli
//  $db = new mysqli(SER,UZY,HAS,BAZ); 
//  $db->set_charset("utf8");
//  if ($mysqli->connect_errno) { echo "Błąd połączenia z MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; }
// 	$query = "SELECT * FROM `_parametry` WHERE typ=1";
// 	$wynik = $db->query($query);
// 	$num = $wynik->num_rows;
// 	for ($i=0; $i<$num; $i++) {
// 		$rekord=$wynik->fetch_assoc();
//		...	
//  }
//  $db->close();
?>