<?php

/**
 * Class uprawnienia v1.0
 * stałe SER,UZY,HAS,BAZ
 * tabela uprawnienia
 */

class Strona {
	
	public $adres_url;

	
	public function __construct() {
		$this->adres_url=strip_tags(trim($_SERVER['REQUEST_URI']));

		
	}
			
	public function ListaUprawnien() {
		
	}
	
	
		
} // Koniec

?>