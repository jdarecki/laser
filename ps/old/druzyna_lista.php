<?php
$kon = b_lac(SER,UZY,HAS,BAZ);
if ($_GET["a"]==1) {
	// zapis - dodanie nowego rekordu
	include($sciezka.$tabela.'_insert'.$roz);	
}
if ($_GET["a"]==2) {
	// forumlarz nowego rekordu
	include($sciezka.$tabela.'_dodaj'.$roz);	
}
if ($_GET["a"]==3) {
	// zapis zmian wybranego rekordu
	include($sciezka.$tabela.'_update'.$roz);	
}
if ($_GET["a"]==4) {
	// formularz zmiany wybranego rekordu
	include($sciezka.$tabela.'_zmien'.$roz);
}
if ($_GET["a"]==5) {
	// przełączenie aktywne/nieaktywne
	$zap="SELECT ".$tabela.".aktywny as aktywny FROM `".$tabela."` WHERE ".$tabela.".nr=".$_GET["r"]." LIMIT 1";
	$wyn5 = mysql_query($zap,$kon);
	$wiersz5=mysql_fetch_array($wyn5);
	if ($wiersz5["aktywny"]) { $aktywny=0; }
	else { $aktywny=1; }
	$zap = "UPDATE `stoczniowiec_baza`.`".$tabela."` SET `aktywny` = '".$aktywny."' WHERE `".$tabela."`.`nr` = ".$_GET["r"].";";
	$wyn6 = mysql_query($zap,$kon);
	$_GET["a"]=0;
}
if ($_GET["a"]==0) {
	// Lista dokumentow

	$zap0="SELECT *	FROM `".$tabela."` ORDER BY `nr` ASC ";
	$zap0="SELECT druzyna.nr as nr, sekcja.nazwa as sekcja, druzyna.nazwa as nazwa, druzyna.aktywny as aktywny 
	FROM druzyna, sekcja 
	WHERE druzyna.sekcja=sekcja.nr 
	ORDER BY `nr` ASC ";
	//paginacja
	$s = ($_GET["s"]>1)?number_format($_GET["s"], 0, "", ""):1; // numer strony
	$na_stronie=15; // liczba rekordow widocznych na stronie
	$na_pasku=5;    // liczba odpowiedzi/2 na pasku
	$wyn0 = mysql_query($zap0,$kon);
	$rekordow = mysql_num_rows($wyn0);
	$stron = ceil($rekordow/$na_stronie);
	if ($s>$stron and $rekordow>0) $s = $stron;
	$start = ($s-1)*$na_stronie;
	$zap=$zap0." limit ".$start.", ".$na_stronie;
	$wyn = mysql_query($zap,$kon);
	$num = mysql_num_rows($wyn);
	$skrypt="index.php".linki('',0)."s=";
	echo pasek2($rekordow,$na_stronie,$na_pasku,$skrypt,$s,"pagination-mini");	
	if($num) {
		echo "<table class=\"table table-striped table-bordered\">";
			echo "<thead>";
			echo "<tr>";
				echo "<th width=\"30\">Nr</th>";
				echo "<th width=\"200\">Nazwa</th>";
				echo "<th width=\"100\">Sekcja</th>";
				echo "<th width=\"60\">Aktywny</th>";
			echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		for ($i=0; $i<$num; $i++) {
			$wiersz=mysql_fetch_array($wyn);
			echo "<tr onmouseover=\"this.className='info'\" onmouseout=\"this.className=''\" onclick=\"document.location='index.php".linki('',0)."a=4&r=".$wiersz["nr"]."'\">";
			//			echo "<tr>";
				echo "<td>".$wiersz["nr"]."</td>";
				echo "<td>".$wiersz["nazwa"]."</td>";
				echo "<td>".$wiersz["sekcja"]."</td>";
				if($wiersz["aktywny"]) $aktywny="<a href=\"index.php".linki('',0)."a=5&r=".$wiersz["nr"]."\"><span class=\"label label-success\"> Aktywny </span></a>"; 
				else $aktywny="<a href=\"index.php".linki('',0)."a=5&r=".$wiersz["nr"]."\"><span class=\"label label-important\"> Niektywny </span></a>";
				echo "<td>".$aktywny."</td>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo pasek2($rekordow,$na_stronie,$na_pasku,$skrypt,$s,"pagination-mini");		
	}
	else {
		echo "<div class=\"alert alert-info\">";
		echo "<p> Brak wpisów spełniających kryteria wyświetlania.</p>";
		echo "</div>";
	}
}	
?>