<?php
define('SER2', 'localhost');
define('UZY2', '02730806_cafetmp');
define('HAS2', 'Jd@6645460');
define('BAZ2', '02730806_cafetmp');

echo "Start";

$db = new mysqli(SER2,UZY2,HAS2,BAZ2); 
if ($mysqli->connect_errno) { echo "Błąd połączenia z MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; }
$result=$db->query("SET NAMES 'utf8'");
$query = "SELECT * FROM wp_posts WHERE guid like '%tmp.ollecafe.pl%' ";
echo "zapytanie=".$query;
$wynik = $db->query($query);
$num = $wynik->num_rows;
$wyn= $wynik->fetch_assoc();
if ($num>0) {
echo "Znalezionych rekordów2:".$num;
}
$zam=strtr($wyn["guid"],'tmp.ollecaffe.pl','ollecaffe.pl');
echo "zam=".$zam;
$zap="UPDATE wp_posts 
SET 
`guid` =  ".$zam."  
WHERE 
`id` = '233'
";
echo "<br>zapytanie update=".$zap;
$wynik2=$db->query($zap); 

$db->close();

?>