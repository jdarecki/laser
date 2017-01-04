<?php
/**
 * Szablon listy - wyświetlanie, dodawanie, modernizacjia
 * pliki:
 * tabela.php - plik główny
 * tabela_lista.php - listarekordów
 * tabela_dodaj.php - formularz dodania
 * tabela_zmien.php - formularz zmiana  
 * tabela_insert.php - nowy rekord
 * tabela_update.php - zmiana rekordu
 */
$tytul=" Drużyna";
$sciezka="skr/"; // ściezka ze skryptem
$tabela="druzyna";      // nazwa
$roz=".php";     // rozszerzenie
$il=2;           // ilość zakładek
if ($_GET["sm"]>($il) or $_GET["sm"]<1 or !$_GET["sm"]) $_GET["sm"]=1;
$active=" class=\"active\"";
$inc="";
// tytuł
echo "<div class=\"alert alert-info\"><i class=\"icon-folder-open\"></i><strong>".$tytul."</strong></div>";
// zakładki
echo "<ul class=\"nav nav-tabs\">";
// zakładka 1
if ($_GET["sm"]==1) { 
$ca=$active; $inc=$sciezka.$tabela.'_lista'.$roz;
} else { $ca=""; }
echo "<li".$ca."><a href=\"index.php".linki('sm',1)."\">Lista ".$tytul."</a></li>";
// zakładka 2
if ($_GET["sm"]==2) { 
$ca=$active; $inc=$sciezka.$tabela.'_lista'.$roz;
} else { $ca=""; }
echo "<li".$ca."><a href=\"index.php".linki('sm',2)."a=2\">Dodaj</a></li>"; 
// koniec zakładki	  
echo "</ul>";		        
// plik z wybrana stroną
if ($inc) { include($inc); }
else { echo "<div class=\"alert-danger\"><p>Błąd</p><p>Podstrona nie istnieje. (sm=".$_GET["sm"].")</p></div>"; }
?>