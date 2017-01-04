<?php
$zap = "UPDATE `stoczniowiec_baza`.`".$tabela."` 
SET 
`sekcja` = '".$_POST["sekcja"]."',
`nazwa`    = '".$_POST["nazwa"]."',
`logo`      = '".$_POST["logo"]."',
`opis`      = '".$_POST["opis"]."'
WHERE `".$tabela."`.`nr` = ".$_GET["r"]."
;";
$wyn = mysql_query($zap,$kon);
if (mysql_errno()) { 
	echo "<div class=\"alert-danger\"><p>Rekord nie został zapisany, błąd numer ".mysql_errno().".</p>"; 
	echo "<p>".mysql_error().".</p><p>".$zap."</p></div>";
	$_GET["a"]=3;
	}
else {	
	echo "<div class=\"alert alert-success\">";
	echo "<p> Formularz został prawidłowo zapisany.</p>";
	echo "</div>";
	$_GET["a"]=0;
}
?>