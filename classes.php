<?php

/**
 * Definicja class.
 * stałe SER,UZY,HAS,BAZ
 * tabela strony
 */

class Strona {
	
	public $adres_url;
	public $menu;
	public $naglowek;
	public $baner;
	public $tresc;
	public $kolumna1;
	public $kolumna2;
	public $kolumna3;
	public $stopka;
	public $tytul_strony;	
	public $slowa_kluczowe;
	public $strona_bledu;
	public $opis_strony;	
	public $adres;
	public $p1;
	public $p2;
	public $p3;
	public $p4;
	public $p5;
	public $p6;
	public $p7;
	public $p8;
	public $p9;
	public $p10;
	
	public function __construct() {
		$this->adres_url=strip_tags(trim($_SERVER['REQUEST_URI']));
		$this->naglowek="ps/naglowek.php";
		$this->menu="ps/menu.php";
		$this->tresc="ps/strona_bledu.php";
		$this->stopka="ps/stopka.php";
		$this->strona_bledu="ps/strona_bledu.php";
		
	}
			
	public function pokazStrone() {
		if (isset($_SESSION['login']) and $_SESSION['login']['numer']>0) {
			if (!$this->filtruj_adres()) { 
				$this->tresc=$this->strona_bledu;
			}	
		} else {
			$this->naglowek="";
			$this->menu="";
			$this->baner="";
			$this->tresc=LOGINSITE;
			$this->stopka="";
		}
		if ($this->naglowek!="") include($this->naglowek);
		if ($this->menu!="") include($this->menu);
		if ($this->baner!="") include($this->baner);
		if ($this->tresc!="") include($this->tresc);
		if ($this->stopka!="") include($this->stopka);
	}
	
	public function filtruj_adres() {
		if(preg_match('/^[a-zA-Z0-9\_\-\/]*$/D',$this->adres_url)) {
			$this->adres = explode("/",$this->adres_url,12);
			$adrestmp=$this->adres[1];
			if ($adrestmp =="") $adrestmp="home";
			if ($this->pobierzZmienne($adrestmp)) 
			return true; else return false;
		}
		else {
			return false;
		}
	}
	
	public function filtruj_string($zmienna) {
		if(preg_match('/^[a-zA-Z0-9\@\.]*$/D',$zmienna)) {
			return true;
		}
		else {
			return false;
		}
	}
	
	public function badr($ile) {
		$adr=ADRES_STRONY;
		if ($ile>0) {
			for ($i=1;$i<=$ile;$i++) {
				if ($this->adres[$i]!="") {
					$adr.="/".$this->adres[$i]; 
				}
			}
		}
		return $adr;
	}
	
	public function pobierzZmienne($id) {
		$db = new mysqli(SER,UZY,HAS,BAZ); 
		if ($mysqli->connect_errno) { echo "Błąd połączenia z MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; }
		$result=$db->query("SET NAMES 'utf8'");
		$query = "SELECT * FROM strony WHERE link='".$id."' and aktywny>0 LIMIT 1";
		$wynik = $db->query($query);
		$num = $wynik->num_rows;
		if ($num>0) {
			$rekord=$wynik->fetch_assoc();
			$this->menu=$rekord["menu"];
			$this->naglowek=$rekord["naglowek"];
			$this->baner=$rekord["baner"];
			$this->tresc=$rekord["tresc"];
			$this->kolumna1=$rekord["kolumna1"];
			$this->kolumna2=$rekord["kolumna2"];
			$this->kolumna3=$rekord["kolumna3"];
			$this->stopka=$rekord["stopka"];
			$this->tytul_strony=$rekord["tytul_strony"];
			$this->slowa_kluczowe=$rekord["slowa_kluczowe"];
			$this->strona_bledu=$rekord["strona_bledu"];
			$this->opis_strony=$rekord["opis_strony"];
			$this->p1=$this->adres[1];
			$this->p2=$this->adres[2];
			$this->p3=$this->adres[3];
			$this->p4=$this->adres[4];
			$this->p5=$this->adres[5];
			$this->p6=$this->adres[6];
			$this->p7=$this->adres[7];
			$this->p8=$this->adres[8];
			$this->p9=$this->adres[9];
			$this->p10=$this->adres[10];
			$db->close();
			return true;
		}
		else {
			$db->close();
			return false;
		}
	}
	
public function pobierzParametry($id) {
		$db = new mysqli(SER,UZY,HAS,BAZ); 
		if ($mysqli->connect_errno) { echo "Błąd połączenia z MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; }
		$result=$db->query("SET NAMES 'utf8'");
		$query = "SELECT * FROM parametry WHERE grupa='".$id."' and aktywny>0 ";
		$wynik = $db->query($query);
		$num = $wynik->num_rows;
		if ($num>0) {
			for ($i=0;$i<$num;$i++) {
				$rekord=$wynik->fetch_assoc();
				$tab[$rekord["nazwa"]]=$rekord[wartosc];
			}	
			$db->close();
			return $tab;
		}
		else {
			$db->close();
			return false;
		}
	}
	
	public function pokaz_zmienne() {
		echo "<div class=\"panel panel-success\">";
		echo "<div class=\"panel-heading\">Wartości zmiennych:</div>";
		echo "<div class=\"panel-body\">";
		echo "<br>menu= ".$this->menu;
		echo "<br>naglowek= ".$this->naglowek;
		echo "<br>baner= ".$this->baner;
		echo "<br>treść= ".$this->tresc;
		echo "<br>kolumna1= ".$this->kolumna1;
		echo "<br>kolumna2= ".$this->kolumna2;
		echo "<br>kolumna3= ".$this->kolumna3;
		echo "<br>stopka= ".$this->stopka;
		echo "<br>tytuł strony= ".$this->tytul_strony;
		echo "<br>słowa kluczowe= ".$this->slowa_kluczowe;
		echo "<br>strona błędu= ".$this->strona_bledu;
		echo "<br>opis strony= ".$this->opis_strony;
		echo "<br>adres 1= ".$this->adres[1];
		echo "<br>adres 2= ".$this->adres[2];
		echo "<br>adres 3= ".$this->adres[3];
		echo "<br>adres 4= ".$this->adres[4];
		echo "<br>adres 5= ".$this->adres[5];
		echo "<br>adres 6= ".$this->adres[6];
		echo "<br>adres 7= ".$this->adres[7];
		echo "<br>adres 8= ".$this->adres[8];
		echo "<br>adres 9= ".$this->adres[9];
		echo "<br>adres 10= ".$this->adres[10];
		echo "<br>adres = ".$this->badr(10);		
		echo "</div></div>";
	}	
		
} // Koniec klasy Strona

?>