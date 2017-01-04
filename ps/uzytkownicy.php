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

 </script>
<?php
class zadania {
	public $tabela;
	public $uzytkownik;
	public $nazwa;
	public $data;
	public $dataz;	
	public $godzina;
	public $priorytet;
	public $opis;
	public $status;
	public $stan;
	public $aktywny;
	public $szukajNazwa;
	public $szukajStatus;
	
	public function __construct() {
		$this->tabela="zadania";
		$this->uzytkownik=$_POST["uzytkownik"];
		$this->nazwa=$_POST["nazwa"];
		$this->data=$_POST["data"];
		$this->dataz=$_POST["dataz"];		
		$this->godzina=$_POST["godzina"];
		$this->priorytet=$_POST["priorytet"];
		$this->opis=$_POST["opis"];
		$this->status=$_POST["status"];
		$this->stan=$_POST["stan"];		
		$this->aktywny=$_POST["aktywny"];
		$this->szukajNazwa=$_POST["szukajNazwa"];
		$this->szukajStatus=$_POST["szukajStatus"];		
	}

    public function tabela_insert() {
		$db = new mysqli(SER,UZY,HAS,BAZ);
		$db->set_charset("utf8");	
		$zap = "INSERT INTO `".$this->tabela."` 
		(`nr`,`uzytkownik`,`nazwa`,`data`,`dataz`,`godzina`,`priorytet`,`opis`,`status`,`stan`,`aktywny`)
		VALUES (NULL,
		'".$this->uzytkownik."', 		
		'".$this->nazwa."', 
		'".$this->data."', 
		'".$this->dataz."', 		
		'".$this->godzina."', 
		'".$this->priorytet."',
		'".$this->opis."',
		'".$this->status."', 
		'".$this->stan."', 		
		'".$this->aktywny."');";
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
	    $db->set_charset("utf8");			
		$zap = "UPDATE `".$this->tabela."` 
		SET 
		`uzytkownik`= '".$this->uzytkownik."',
		`nazwa` 	= '".$this->nazwa."',
		`data`    	= '".$this->data."',
		`dataz`    	= '".$this->dataz."',		
		`godzina`   = '".$this->godzina."',
		`priorytet` = '".$this->priorytet."',		
		`opis`      = '".$this->opis."',
		`status`    = '".$this->status."',
		`stan`      = '".$this->stan."',		
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
	
	public function szukajform($p2) {
		echo "<form action=\"".ADRES_STRONY."/".$this->tabela."/".$p2."\" class=\"form-inline\" method=\"post\" id=\"zadania_zmien\">";
		echo "<table style=\"margin:5px 0px 5px 0px\"><tr>";
		echo "<td><input name=\"szukajNazwa\" type=\"text\" class=\"form-control\" id=\"pole1\" placeholder=\"nazwa\"></td>";
		echo "<td><button type=\"submit\" class=\"btn btn-default\"> Szukaj </button></td>";		
		echo "</tr></table>";
		echo "</form>";
	}
	
	public function kolory($d1,$d2,$s) {
		$kol=array("#ff0000","#ff3300","#ff6600","#ff9900","#ffcc00","#ffff00","#ccff00","#99ff00","#66ff00","#33ff00");
		$dd=date("Y-m-d");
		$data=explode('-',$d1);
		$dataz=explode('-',$d2);
		$dzis=explode('-',$dd);
		$r1=mktime(0,0,0,$data[1],$data[2],$data[0]);
		$r2=mktime(0,0,0,$dataz[1],$dataz[2],$dataz[0]);
		$r3=mktime(0,0,0,$dzis[1],$dzis[2],$dzis[0]);
		$d=round(($r2-$r1)/(60*60*24));
		$r=round(($r3-$r1)/(60*60*24));
		$rel1=$r*100/$d;
		$rel2=round(6+(($s-$rel1)/10));
		if ($rel2>9) {$rel2=9;}
		if ($rel2<0) {$rel2=0;}
		return $kol[$rel2];
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
		$zap0="SELECT zadania.nr as nr, zadania.data as data, zadania.dataz as dataz, zadania.nazwa as nazwa, uzytkownik.nazwa as uzytkownik, priorytet.nazwa as priorytet, 
			priorytet.kolort as kolort, priorytet.kolorn as kolorn, status.nazwa as status
		FROM ".$this->tabela.", uzytkownik, priorytet, status
		WHERE zadania.uzytkownik=uzytkownik.nr and zadania.priorytet=priorytet.nr and zadania.status=status.nr and zadania.aktywny>0 
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
			$this->szukajform($p2);
			echo "<table class=\"table table-striped table-bordered\">";
			echo "<thead>";
			echo "<tr style=\"background-color:#ececec; color:#666666;\">";
				echo "<th width=\"30\">Nr</th>";
				echo "<th width=\"100\">Data</th>";
				echo "<th >Nazwa</th>";
				echo "<th width=\"10\">&nbsp;</th>";
				echo "<th width=\"100\">Użytkownik</th>";
				echo "<th width=\"70\">Priorytet</th>";
				echo "<th width=\"80\">Status</th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			for ($i=0; $i<$num; $i++) {
				$wiersz=$wyn->fetch_assoc();
				echo "<tr onmouseover=\"this.className='info'\" onmouseout=\"this.className=''\" onclick=\"document.location='".ADRES_STRONY."/".$this->tabela."/".$p2."/pokaz/".$wiersz["nr"]."'\">";
					echo "<td>".$wiersz["nr"]."</td>";
					echo "<td>".$wiersz["data"]."</td>";
					$k=$this->kolory($wiersz["data"],$wiersz["dataz"],$wiersz["stan"]);
					echo "<td>".$wiersz["nazwa"].$k."</td>";
					echo "<td><a href=\"".ADRES_STRONY."/".$this->tabela."/".$ps."/pokaz/".$wiersz["nr"]."\"><span class=\"glyphicon glyphicon-open-file\" aria-hidden=\"true\"></span></a></td>";
					echo "<td>".$wiersz["uzytkownik"]."</td>";
					echo "<td style=\"background-color:#".$wiersz["kolort"]."; color:#".$wiersz["kolorn"].";\">".$wiersz["priorytet"]."</td>";
					echo "<td style=\"background-color:".$k.";\">".$wiersz["status"]."</td>";
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
			echo pasek2($rekordow,$na_stronie,$na_pasku,$skrypt,$s,"pagination-sm");	
			
		} else {
			echo "<div class=\"alert alert-info\">";
			echo "<p> Brak wpisów spełniających kryteria wyświetlania.</p>";
			echo "</div>";
		}
		$db->close();
		 
	}
	
	public function tabela_listauser($u,$p2,$p3) {
		$db = new mysqli(SER,UZY,HAS,BAZ);
		$db->set_charset("utf8");
		$zap0="SELECT zadania.nr as nr, zadania.data as data, zadania.nazwa as nazwa, priorytet.nazwa as priorytet, 
			priorytet.kolort as kolort, priorytet.kolorn as kolorn 
		FROM ".$this->tabela.", priorytet  
		WHERE uzytkownik=".$u." and zadania.priorytet=priorytet.nr and zadania.aktywny>0 
		ORDER BY nr DESC";	
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
			$this->szukajform($p2);
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
					echo "<td style=\"background-color:#".$wiersz["kolort"]."; color:#".$wiersz["kolorn"].";\">".$wiersz["priorytet"]."</td>";
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
			echo pasek2($rekordow,$na_stronie,$na_pasku,$skrypt,$s,"pagination-sm");	
			
		} else {
			echo "<div class=\"alert alert-info\">";
			echo "<p> Brak wpisów spełniających kryteria wyświetlania.</p>";
			echo "</div>";
		}
		$db->close();
		 
	}
	
	public function tabela_popraw($p2,$p4) {
		$db = new mysqli(SER,UZY,HAS,BAZ);
		$db->set_charset("utf8");
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
			echo "<td width=\"".$s1."\" colspan=\"2\">";
			echo "<input type=\"text\" name=\"nazwa\" value=\"".$wiersz["nazwa"]."\" class=\"form-control\" ";
			echo "</td><td>&nbsp;</td>";
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
			// Pole stan 
			echo "<tr>";
			echo "<td width=\"100\">Stan</td>";
			echo "<td>";
			echo "<input type=\"range\" name=\"stan\" value=\"".$wiersz["stan"]."\" min=\"0\" max=\"100\">";
			echo "</td><td>&nbsp;</td><td>&nbsp;</td>";
			echo "</tr>";
			// Pole priorytet
			echo "<tr>";
			echo "<td width=\"100\">Priorytet</td>";
			echo "<td width=\"".$s1."\">";
			$this->pole_select("priorytet","priorytet",$wiersz["priorytet"]);
			echo "</td><td>&nbsp;</td><td>&nbsp;</td>";
			echo "</tr>";
			// Pole status
			echo "<tr>";
			echo "<td width=\"100\">Status</td>";
			echo "<td width=\"".$s1."\">";
			$this->pole_select("status","status",$wiersz["status"]);
			echo "</td><td>&nbsp;</td><td>&nbsp;</td>";
			echo "</tr>";
			// Pole opis
			echo "<tr>";
			echo "<td width=\"100\">Opis</td>";
			echo "<td width=\"".$s1."\" colspan=\"3\">";
			echo "<textarea class=\"form-control\" name=\"opis\" id=\"editor1\" rows=\"5\">".$wiersz["opis"]."</textarea>";
			echo "<script>CKEDITOR.replace( 'editor1', {filebrowserBrowseUrl:'/fileman/index.html'});</script>";
			echo "</td>";
			echo "</tr>";
			// Przewidywana data zakończenia
			echo "<tr>";
			echo "<td width=\"100\">Data zakończenia</td>";
			echo "<td width=\"".$s1."\">";
			echo "<input type=\"date\" name=\"dataz\" value=\"".$wiersz["dataz"]."\" class=\"form-control\" ";
			echo "</td><td>&nbsp;</td><td>&nbsp;</td>";
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
	public function tabela_aktualizuj($p2,$p4) {
		$db = new mysqli(SER,UZY,HAS,BAZ);
		$db->set_charset("utf8");
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
			
			// Pole stan 
			echo "<tr>";
			echo "<td width=\"100\">Stan</td>";
			echo "<td>";
			echo "<input type=\"range\" name=\"stan\" value=\"".$wiersz["stan"]."\" min=\"0\" max=\"100\">";
			echo "</td><td>&nbsp;</td><td>&nbsp;</td>";
			echo "</tr>";
			// Przewidywana data zakończenia
			echo "<tr>";
			echo "<td width=\"100\">Data zakończenia</td>";
			echo "<td width=\"".$s1."\">";
			echo "<input type=\"date\" name=\"dataz\" value=\"".$wiersz["dataz"]."\" class=\"form-control\" ";
			echo "</td><td>&nbsp;</td><td>&nbsp;</td>";
			echo "</tr>";
			// Pole status
			echo "<tr>";
			echo "<td width=\"100\">Status</td>";
			echo "<td width=\"".$s1."\">";
			$this->pole_select("status","status",$wiersz["status"]);
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
			echo "<script>CKEDITOR.replace( 'editor1', {filebrowserBrowseUrl:'/fileman/index.html'});</script>";
			echo "</td>";
			echo "</tr>";
			// Button submit
			echo "<tr>";
			echo "<td width=\"100\">";
			echo "<button type=\"submit\" class=\"btn btn-primary\"> Zapisz zmiany </button>";
			echo "</td>";
			echo "<td width=\"".$s1."\">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
			echo "</tr>";
			// pola ukryte
			
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
		$s1=250;$s2=350;
		echo "<form action=\"".ADRES_STRONY."/".$this->tabela."/dodajform/dodaj\" method=\"post\" id=\"zadania_dodaj\">";
		echo "<table class=\"table\">";
		// Pole numer 
		echo "<tr>";
		echo "<td width=\"100\">Numer:</td>";
		echo "<td width=\"".$s1."\">";
		echo "<input type=\"text\" name=\"numer\" value=\"\" disabled=\"disabled\" class=\"form-control\" placeholder=\"autonumeracja\" ";
		echo "</td><td width=\"".$s2."\">&nbsp;</td><td>&nbsp;</td>";
		echo "</tr>";
		// Pole uzytkownik
		echo "<tr>";
		echo "<td width=\"100\">Użytkownik</td>";
		echo "<td>";
		echo "<input type=\"text\" name=\"uzytkownik\" value=\"".$_SESSION['login']['numer']."\" readonly class=\"form-control\" placeholder=\"".$_SESSION['login']['nick']."\" ";
		echo "</td><td>&nbsp;</td><td>&nbsp;</td>";
		echo "</tr>";
		// Pole nazwa
		echo "<tr>";
		echo "<td width=\"100\">Nazwa</td>";
		echo "<td colspan=\"2\">";
		echo "<input type=\"text\" name=\"nazwa\" value=\"\" class=\"form-control\"";
		echo "</td><td>&nbsp;</td>";
		echo "</tr>";
		// Pole data 
		echo "<tr>";
		echo "<td width=\"100\">Data</td>";
		echo "<td>";
		$data=date("Y-m-d");
		echo "<input type=\"date\" name=\"data\" value=\"".$data."\" class=\"form-control\" readonly ";
		echo "</td><td>&nbsp;</td><td>&nbsp;</td>";
		echo "</tr>";
		// Pole godzina
		echo "<tr>";
		echo "<td width=\"100\">Godzina</td>";
		echo "<td>";
		$godzina=date("H:i:s");
		echo "<input type=\"time\" name=\"godzina\" value=\"".$godzina."\" class=\"form-control\" readonly ";
		echo "</td><td>&nbsp;</td><td>&nbsp;</td>";
		echo "</tr>";
		// Pole stan 
		echo "<tr>";
		echo "<td width=\"100\">Stan</td>";
		echo "<td>";
		echo "<input type=\"range\" name=\"stan\" value=\"0\" min=\"0\" max=\"100\">";
		echo "</td><td>&nbsp;</td><td>&nbsp;</td>";
		echo "</tr>";
		// Pole priorytet 
		echo "<tr>";
		echo "<td width=\"100\">Priorytet</td>";
		echo "<td>";
		$this->pole_select("priorytet","priorytet",1);
		echo "</td><td>&nbsp;</td><td>&nbsp;</td>";
		echo "</tr>";
		// Pole status
		echo "<tr>";
		echo "<td width=\"100\">Status</td>";
		echo "<td>";
		$this->pole_select("status","status",1);
		echo "</td><td>&nbsp;</td><td>&nbsp;</td>";
		echo "</tr>";
		// Pole opis
		echo "<tr>";
		echo "<td width=\"100\">Opis</td>";
		echo "<td colspan=\"3\">";
		echo "<textarea class=\"form-control\" name=\"opis\" id=\"editor1\" rows=\"5\"></textarea>";
		echo "<script>CKEDITOR.replace( 'editor1', {filebrowserBrowseUrl:'/fileman/index.html'});</script>";		
		echo "</td>";
		echo "</tr>";
		// Przewidywana data zakończenia
		echo "<tr>";
		echo "<td width=\"100\">Data zakończenia</td>";
		echo "<td>";
		$data=date("Y-m-d");
		echo "<input type=\"date\" name=\"dataz\" value=\"".$data."\" class=\"form-control\"";
		echo "</td><td>&nbsp;</td><td>&nbsp;</td>";
		echo "</tr>";
		// Pole aktywny
		echo "<tr>";
		echo "<td width=\"100\">Aktywny</td>";
		echo "<td>";
		$aktywnyDefault=1;
		if ($aktywnyDefault==1) {
		echo "Aktywny: <input type=\"radio\" name=\"aktywny\" value=\"1\" checked> &nbsp;&nbsp;&nbsp;";
		echo "Nieaktywny: <input type=\"radio\" name=\"aktywny\" value=\"0\">";
		} else {
		echo "Aktywny: <input type=\"radio\" name=\"aktywny\" value=\"1\"> &nbsp;&nbsp;&nbsp;";
		echo "Nieaktywny: <input type=\"radio\" name=\"aktywny\" value=\"0\" checked>";
		}
		echo "</td><td>&nbsp;</td><td>&nbsp;</td>";
		echo "</tr>";
		// Button submit
		echo "<tr>";
		echo "<td width=\"100\">";
		echo "<button type=\"submit\" class=\"btn btn-primary\"> Zapisz </button>";
		echo "</td>";
		echo "<td>&nbsp;</td><td>&nbsp;</td>";
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
//echo "<div style=\"padding:5px 0px 0px 0px;\">";
//echo "<ul class=\"nav nav-tabs\">";
//	if ($this->p2=="lista") { $a="class=\"active\""; } else { $a=""; } 
//	echo "<li role=\"presentation\" ".$a."><a href=\"".ADRES_STRONY."/".$this->p1."/lista\">Lista zadań</a></li>";
//	$a="";
//	if ($this->p2=="listauser") { $a="class=\"active\""; } else { $a=""; }
//	echo "<li role=\"presentation\" ".$a."><a href=\"".ADRES_STRONY."/".$this->p1."/listauser\">".$_SESSION['login']['nazwa']."</a></li>";
//	$a=""; 
//	if ($this->p2=="dodajform") { $a="class=\"active\""; } else { $a=""; }
//	echo "<li role=\"presentation\" ".$a."><a href=\"".ADRES_STRONY."/".$this->p1."/dodajform\">Dodaj</a></li>";
//	$a="";
//echo "</ul>";
//echo "</div>";
// akcja


echo "<div style=\"\">";
echo "<br>";
echo "<h3>Lista użytkowników</h3>";

// LISTA UŻYTKOWNIKÓW
$db = new mysqli(SER,UZY,HAS,BAZ);
		$db->set_charset("utf8");
		$zap="SELECT * FROM `uzytkownik`";		
		$wyn = $db->query($zap);
		$num = $wyn->num_rows;
		for ($i=0;$i<$num;$i++) {
			$wie=$wyn->fetch_assoc();
			echo $wie["nr"]."&nbsp;".$wie["nazwisko"]."&nbsp;".$wie["imie"]."&nbsp;".$wie["nazwa"]."&nbsp;".$wie["login"]."&nbsp;".$wie["email"]."&nbsp;".$wie["grupa"]."&nbsp;";
			echo "<br>";
		}

echo "</div>";


$par=$this->pobierzParametry(3);
if ($par) {
	foreach ($par as $klucz => $wartosc) {
		echo "<br>".$klucz."=".$wartosc."";
	}
}

echo ".<br>";
echo ".<br>".$par["sprzedaz_tlo"];
echo ".<br>".$par["administracja_ikona"];


// Lista zmiennych	
$this->pokaz_zmienne();
?>