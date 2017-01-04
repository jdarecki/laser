<?php
$zap = "INSERT INTO `stoczniowiec_baza`.`".$tabela."` 
(`nr`,`sekcja`,`nazwa`,`logo`,`opis`,`aktywny`)
VALUES (NULL,
'".$_POST["sekcja"]."', 
'".$_POST["nazwa"]."', 
'".$_POST["logo"]."', 
'".$_POST["opis"]."', 
'0');";
$wyn = mysql_query($zap,$kon);
if (mysql_errno()) { 
	echo "<div class=\"alert-danger\"><p>Rekord nie został zapisany, błąd numer ".mysql_errno().".</p>"; 
	echo "<p>".mysql_error().".</p><p>".$zap."</p></div>";
	$_GET["a"]=2;
	}
else {	
	echo "<div class=\"alert alert-success\">";
	echo "<p> Wpis został prawidłowo dodany.</p>";
	echo "</div>";
	$_GET["a"]=0;
}
?>
