<!-- Zadania -->
<!-- Zadania
----kolory light - ziel:dff0d8, nieb:d9edf7, zlot:fcf8e3, czer:f2dede
----kolory nieb: 337ab7, ziel:5cb85c, nieb:5bc0de, zlot:f0ad4e, czer:d9534f, szary:777777
-->
<!-- Make sure the path to CKEditor is correct. -->

<?php
echo "<script src=\"".ADRES_STRONY."/ckeditor/ckeditor.js\"></script>";
?>
<script>
CKEDITOR.editorConfig = function( config ) {
	config.language = 'es';
	config.uiColor = '#F7B42C';
	config.height = 300;
	config.toolbarCanCollapse = true;
};
var roxyFileman = '/fileman/index.html'; 
$(function(){
   CKEDITOR.replace( 'editor1',{filebrowserBrowseUrl:roxyFileman,
                                filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                                removeDialogTabs: 'link:upload;image:upload'}); 
});
 </script>
<?php
class zadania {
	public $tabela;
	public $uzytkownik;
	public $nazwa;
	public $data;
	public $godzina;
	public $priorytet;
	public $opis;
	public $aktywny;
	
	public function __construct() {
		$this->tabela="zadania";
		$this->uzytkownik=$_POST["uzytkownik"];
		$this->nazwa=$_POST["nazwa"];
		$this->data=$_POST["data"];
		$this->godzina=$_POST["godzina"];
		$this->priorytet=$_POST["priorytet"];
		$this->opis=$_POST["opis"];
		$this->aktywny=$_POST["aktywny"];
	}

    public function tabela_insert() {
		$db = new mysqli(SER,UZY,HAS,BAZ);
		$zap = "INSERT INTO `".$this->tabela."` 
		(`nr`,`uzytkownik`,`nazwa`,`data`,`godzina`,`priorytet`,`opis`,`aktywny`)
		VALUES (NULL,
		'".$this->uzytkownik."', 		
		'".$this->nazwa."', 
		'".$this->data."', 
		'".$this->godzina."', 
		'".$this->priorytet."',
		'".$this->opis."', 
		'0');";
		$wynik=$db->query($zap);
		if ($mysqli->error) { echo "Błąd mysql: ".$mysqli->error; }	else {
			echo "<div class=\"alert alert-info\">";
			echo "<p> Dodano nowy wpis.</p>";
			echo "</div>";
		}	
		$db->close();
    }
	
	
	
	 public function tabela_update($numer) {
		$db = new mysqli(SER,UZY,HAS,BAZ);		 
		$zap = "UPDATE `".$this->tabela."` 
		SET 
		`uzytkownik`= '".$this->uzytkownik."',
		`nazwa` 	= '".$this->nazwa."',
		`data`    	= '".$this->data."',
		`godzina`   = '".$this->godzina."',
		`priorytet` = '".$this->priorytet."',		
		`opis`      = '".$this->opis."',
		`aktywny`   = '".$this->aktywny."'		
		WHERE `nr` = ".$numer."
		;";
		$wynik=$db->query($zap);
		if ($mysqli->error) { echo "Błąd mysql: ".$mysqli->error; } else {
			echo "<div class=\"alert alert-info\">";
			echo "<p> Poprawki zostały zapisane.</p>";
			echo "</div>";
		}
		$db->close();
	 }
	
	public function pole_select($nam,$tab,$war) {
	//nam:nazwa zmiennej
	//tab:tabela
	//war:wartość domyślna
	$db = new mysqli(SER,UZY,HAS,BAZ);	
	$db->set_charset("utf8");	
	$zap = "SELECT * FROM ".$tab." WHERE aktywny>0 ORDER BY nr";
	$wyn=$db->query($zap);
	$num=$wyn->num_rows;
	if ($num) {
		echo "<select class=\"form-control\" name=\"".$nam."\" size=\"1\" >";
		for ($i=0;$i<$num;$i++) {
			$wie=$wyn->fetch_assoc();
			if ($wie[nr]==$war) {
				{ echo "<option value=\"".$wie["nr"]."\" selected>".$wie["nazwa"]."</option>"; }
			} else {
				{ echo "<option value=\"".$wie["nr"]."\">".$wie["nazwa"]."</option>";  } 
			}
		}
		echo "</select>";
	} else { echo "Brak słownika!";}
	$db->close();
	}
	
	public function tabela_lista($p2,$p3) {
		$db = new mysqli(SER,UZY,HAS,BAZ);
		$db->set_charset("utf8");
		$zap0="SELECT zadania.nr as nr, zadania.data as data, zadania.nazwa as nazwa, uzytkownik.nazwa as uzytkownik, priorytet.nazwa as priorytet, 
			priorytet.kolort as kolort, priorytet.kolorn as kolorn
		FROM ".$this->tabela.", uzytkownik, priorytet
		WHERE zadania.uzytkownik=uzytkownik.nr and zadania.priorytet=priorytet.nr and zadania.aktywny>0 
		ORDER BY `nr` DESC";		
		//paginacja
		$s = ($p3>1)?number_format($p3, 0, "", ""):1; // numer strony
		$na_stronie=15; // liczba rekordow widocznych na stronie
		$na_pasku=5;    // liczba odpowiedzi/2 na pasku
		$wyn0 = $db->query($zap0);
		$rekordow = $wyn0->num_rows; 
		$stron = ceil($rekordow/$na_stronie);
		if ($s>$stron and $rekordow>0) $s = $stron;
		$start = ($s-1)*$na_stronie;
		$zap=$zap0." limit ".$start.", ".$na_stronie;
		$wyn = $db->query($zap);
		$num = $wyn->num_rows;
		$skrypt=ADRES_STRONY."/".$this->tabela."/".$p2."/";
		if($num) {
			echo "<table class=\"table table-striped table-bordered\">";
			echo "<thead>";
			echo "<tr style=\"background-color:#ececec; color:#666666;\">";
				echo "<th width=\"30\">Nr</th>";
				echo "<th width=\"100\">Data</th>";
				echo "<th >Nazwa</th>";
				echo "<th width=\"100\">Użytkownik</th>";
				echo "<th width=\"60\">Priorytet</th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			for ($i=0; $i<$num; $i++) {
				$wiersz=$wyn->fetch_assoc();
				echo "<tr onmouseover=\"this.className='info'\" onmouseout=\"this.className=''\" onclick=\"document.location='".ADRES_STRONY."/".$this->tabela."/".$p2."/pokaz/".$wiersz["nr"]."'\">";
					echo "<td>".$wiersz["nr"]."</td>";
					echo "<td>".$wiersz["data"]."</td>";
					echo "<td>".$wiersz["nazwa"]."</td>";
					echo "<td>".$wiersz["uzytkownik"]."</td>";
					echo "<td style=\"background-color:#".$wiersz["kolort"]."; color:#".$wiersz["kolorn"].";\">".$wiersz["priorytet"]."</td>";
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
			echo pasek2($rekordow,$na_stronie,$na_pasku,$skrypt,$s,"pagination pagination-sm");	
			
		} else {
			echo "<div class=\"alert alert-info\">";
			echo "<p> Brak wpisów spełniających kryteria wyświetlania.</p>";
			echo "</div>";
		}
		$db->close();
		 
	}
	
	public function tabela_listauser($u,$p2,$p3) {
		$db = new mysqli(SER,UZY,HAS,BAZ);
		$zap0="SELECT * FROM ".$this->tabela." WHERE uzytkownik=".$u." ORDER BY nr DESC";	
		//paginacja
		$s = ($p3>1)?number_format($p3, 0, "", ""):1; // numer strony
		$na_stronie=15; // liczba rekordow widocznych na stronie
		$na_pasku=5;    // liczba odpowiedzi/2 na pasku
		$wyn0 = $db->query($zap0);
		$rekordow = $wyn0->num_rows; 
		$stron = ceil($rekordow/$na_stronie);
		if ($s>$stron and $rekordow>0) $s = $stron;
		$start = ($s-1)*$na_stronie;
		$zap=$zap0." limit ".$start.", ".$na_stronie;
		$wyn = $db->query($zap);
		$num = $wyn->num_rows;
		$skrypt=ADRES_STRONY."/".$this->tabela."/".$p2."/";
		if($num) {
			echo "<table class=\"table table-striped table-bordered\">";
			echo "<thead>";
			echo "<tr>";
				echo "<th width=\"30\">Nr</th>";
				echo "<th width=\"100\">Data</th>";
				echo "<th >Nazwa</th>";
				echo "<th width=\"60\">Priorytet</th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			for ($i=0; $i<$num; $i++) {
				$wiersz=$wyn->fetch_assoc();
				echo "<tr onmouseover=\"this.className='info'\" onmouseout=\"this.className=''\" onclick=\"document.location='".ADRES_STRONY."/".$this->tabela."/".$p2."/pokaz/".$wiersz["nr"]."'\">";
					echo "<td>".$wiersz["nr"]."</td>";
					echo "<td>".$wiersz["data"]."</td>";
					echo "<td>".$wiersz["nazwa"]."</td>";
					echo "<td>".$wiersz["priorytet"]."</td>";
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
			echo pasek2($rekordow,$na_stronie,$na_pasku,$skrypt,$s,"pagination pagination-sm");	
			
		} else {
			echo "<div class=\"alert alert-info\">";
			echo "<p> Brak wpisów spełniających kryteria wyświetlania.</p>";
			echo "</div>";
		}
		$db->close();
		 
	}
	
	public function tabela_popraw($p2,$p4) {
		$db = new mysqli(SER,UZY,HAS,BAZ);
		$zap="SELECT * FROM ".$this->tabela." WHERE `nr`=".$p4." LIMIT 1";		
		$wyn = $db->query($zap);
		$num = $wyn->num_rows;
		$s1=250;$s2=350;
		if($num) {
			$wiersz=$wyn->fetch_assoc();
			echo "<form action=\"".ADRES_STRONY."/".$this->tabela."/".$p2."/zmien/".$p4."\" method=\"post\" id=\"zadania_zmien\">";
			echo "<table class=\"table\">";
			// Pole numer 
			echo "<tr>";
			echo "<td width=\"100\">Numer:</td>";
			echo "<td width=\"".$s1."\">";
			echo "<input type=\"text\" name=\"numer\" value=\"".$wiersz["nr"]."\" disabled=\"disabled\" class=\"form-control\" ";
			echo "</td><td width=\"".$s2."\">&nbsp;</td><td>&nbsp;</td>";
			echo "</tr>";
			// Pole uzytkownik
			echo "<tr>";
			echo "<td width=\"100\">Użytkownik</td>";
			echo "<td width=\"".$s1."\">";
			$this->pole_select("uzytkownik","uzytkownik",$wiersz["uzytkownik"]);
			echo "</td><td>&nbsp;</td><td>&nbsp;</td>";
			echo "</tr>";
			// Pole nazwa
			echo "<tr>";
			echo "<td width=\"100\">Nazwa</td>";
			echo "<td width=\"".$s1."\">";
			echo "<input type=\"text\" name=\"nazwa\" value=\"".$wiersz["nazwa"]."\" class=\"form-control\" ";
			echo "</td><td>&nbsp;</td><td>&nbsp;</td>";
			echo "</tr>";
			// Pole data 
			echo "<tr>";
			echo "<td width=\"100\">Data</td>";
			echo "<td width=\"".$s1."\">";
			echo "<input type=\"date\" name=\"data\" value=\"".$wiersz["data"]."\" class=\"form-control\" ";
			echo "</td><td>&nbsp;</td><td>&nbsp;</td>";
			echo "</tr>";
			// Pole godzina
			echo "<tr>";
			echo "<td width=\"100\">Godzina</td>";
			echo "<td width=\"".$s1."\">";
			echo "<input type=\"time\" name=\"godzina\" value=\"".$wiersz["godzina"]."\" class=\"form-control\" ";
			echo "</td><td>&nbsp;</td><td>&nbsp;</td>";
			echo "</tr>";
			// Pole priorytet
			echo "<tr>";
			echo "<td width=\"100\">Priorytet</td>";
			echo "<td width=\"".$s1."\">";
			$this->pole_select("priorytet","priorytet",$wiersz["priorytet"]);
			echo "</td><td>&nbsp;</td><td>&nbsp;</td>";
			echo "</tr>";
			// Pole opis
			echo "<tr>";
			echo "<td width=\"100\">Opis</td>";
			echo "<td width=\"".$s1."\" colspan=\"3\">";
			echo "<textarea class=\"form-control\" name=\"opis\" id=\"editor1\" rows=\"5\">".$wiersz["opis"]."</textarea>";
			echo "<script>CKEDITOR.replace( 'editor1' );</script>";
			echo "</td>";
			echo "</tr>";
			// Pole aktywny
			echo "<tr>";
			echo "<td width=\"100\">Aktywny</td>";
			echo "<td width=\"".$s1."\">";
			if ($wiersz["aktywny"]==1) {
			echo "Aktywny: <input type=\"radio\" name=\"aktywny\" value=\"1\" checked> &nbsp;&nbsp;&nbsp;";
			echo "Nieaktywny: <input type=\"radio\" name=\"aktywny\" value=\"0\">";
			} else {
			echo "Aktywny: <input type=\"radio\" name=\"aktywny\" value=\"1\"> &nbsp;&nbsp;&nbsp;";
			echo "Nieaktywny: <input type=\"radio\" name=\"aktywny\" value=\"0\" checked>";
			}
			//echo "<input class=\"form-control\" type=\"text\" name=\"aktywny\" value=\"".$wiersz["aktywny"]."\" ";
			echo "</td><td>&nbsp;</td><td>&nbsp;</td>";
			echo "</tr>";
			// Button submit
			echo "<tr>";
			echo "<td width=\"100\">";
			echo "<button type=\"submit\" class=\"btn btn-primary\"> Zapisz zmiany </button>";
			echo "</td>";
			echo "<td width=\"".$s1."\">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
			echo "</tr>";
			// koniec formularza 
			echo "</table>";
			echo "</form>";
		} else {
			echo "<div class=\"alert alert-info\">";
			echo "<p> Brak wpisów spełniających kryteria wyświetlania.</p>";
			echo "</div>";
		}
		$db->close();
	}
	
	public function tabela_dodaj() {
		echo "<form action=\"".ADRES_STRONY."/".$this->tabela."/dodajform/dodaj\" method=\"post\" id=\"zadania_dodaj\">";
		echo "<table class=\"table\">";
		// Pole numer 
		echo "<tr>";
		echo "<td width=\"100\">Numer:</td>";
		echo "<td width=\"200\">";
		echo "<input type=\"text\" name=\"numer\" value=\"\" disabled=\"disabled\" class=\"form-control\"";
		echo "</td><td>&nbsp;</td>";
		echo "</tr>";
		// Pole uzytkownik
		echo "<tr>";
		echo "<td width=\"100\">Użytkownik</td>";
		echo "<td width=\"200\">";
		
		echo "<input type=\"text\" name=\"uzytkownik\" value=\"".$_SESSION['login']['nr']."\" disabled=\"disabled\" class=\"form-control\"";
		echo "</td><td>&nbsp;</td>";
		echo "</tr>";
		// Pole nazwa
		echo "<tr>";
		echo "<td width=\"100\">Nazwa</td>";
		echo "<td width=\"200\">";
		echo "<input type=\"text\" name=\"nazwa\" value=\"\" class=\"form-control\"";
		echo "</td><td>&nbsp;</td>";
		echo "</tr>";
		// Pole data 
		echo "<tr>";
		echo "<td width=\"100\">Data</td>";
		echo "<td width=\"200\">";
		echo "<input type=\"text\" name=\"data\" value=\"\" class=\"form-control\"";
		echo "</td><td>&nbsp;</td>";
		echo "</tr>";
		// Pole godzina
		echo "<tr>";
		echo "<td width=\"100\">Godzina</td>";
		echo "<td width=\"200\">";
		echo "<input type=\"text\" name=\"godzina\" value=\"\" class=\"form-control\"";
		echo "</td><td>&nbsp;</td>";
		echo "</tr>";
		// Pole priorytet
		echo "<tr>";
		echo "<td width=\"100\">Priorytet</td>";
		echo "<td width=\"200\">";
		$this->pole_select("priorytet","priorytet",1);
		echo "</td><td>&nbsp;</td>";
		echo "</tr>";
		// Pole opis
		echo "<tr>";
		echo "<td width=\"100\">Opis</td>";
		echo "<td width=\"200\">";
		echo "<input type=\"text\" name=\"opis\" value=\"\" class=\"form-control\"";
		echo "</td><td>&nbsp;</td>";
		echo "</tr>";
		// Pole aktywny
		echo "<tr>";
		echo "<td width=\"100\">Aktywny</td>";
		echo "<td width=\"200\">";
		echo "<input type=\"text\" name=\"aktywny\" value=\"\" class=\"form-control\"";
		echo "</td><td>&nbsp;</td>";
		echo "</tr>";
		// Button submit
		echo "<tr>";
		echo "<td width=\"100\">";
		echo "<button type=\"submit\" class=\"btn btn-primary\"> Zapisz </button>";
		echo "</td>";
		echo "<td width=\"200\">&nbsp;</td><td>&nbsp;</td>";
		echo "</tr>";
		// koniec formularza 
		echo "</table>";
		echo "</form>";
	}
	
}
// p1 - menu: zadania
// p2 - zakładki: lista, listauser, dodajform
// p3 - akcja: dodaj, zmien
// p4 - parametr
// p5 - parametr paginacja
$lista = new zadania;
if ($this->p2=="") { $this->p2="lista"; }
// Zakładki
echo "<div style=\"padding:5px 0px 0px 0px;\">";
echo "<ul class=\"nav nav-tabs\">";
	if ($this->p2=="lista") { $a="class=\"active\""; } else { $a=""; } 
	echo "<li role=\"presentation\" ".$a."><a href=\"".ADRES_STRONY."/".$this->p1."/lista\">Lista zadań</a></li>";
	$a="";
	if ($this->p2=="listauser") { $a="class=\"active\""; } else { $a=""; }
	echo "<li role=\"presentation\" ".$a."><a href=\"".ADRES_STRONY."/".$this->p1."/listauser\">".$_SESSION['login']['nazwa']."</a></li>";
	$a=""; 
	if ($this->p2=="dodajform") { $a="class=\"active\""; } else { $a=""; }
	echo "<li role=\"presentation\" ".$a."><a href=\"".ADRES_STRONY."/".$this->p1."/dodajform\">Dodaj</a></li>";
	$a="";
echo "</ul>";
echo "</div>";
// akcja
if ($this->p2=="lista") { 
		if ($this->p3=="pokaz") {
			$lista->tabela_popraw($this->p2,$this->p4);
		}
		if ($this->p3=="zmien") {
			$lista->tabela_update($this->p4);
		}
		$lista->tabela_lista($this->p2,$this->p3);
	}
if ($this->p2=="listauser") { 
	if ($this->p3=="pokaz") {
		$lista->tabela_popraw($this->p2,$this->p4);
	}
	if ($this->p3=="zmien") {
		$lista->tabela_update($this->p4);
	}
	$lista->tabela_listauser($_SESSION['login']['numer'],$this->p2,$this->p3);
}
if ($this->p2=="dodajform") { 
	if ($this->p3=="dodaj") {
		$lista->tabela_insert();
	}
	$lista->tabela_dodaj();
}

// Lista zmiennych	
$this->pokaz_zmienne();
?>