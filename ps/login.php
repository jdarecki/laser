<style type="text/css">
#bg {
  position: fixed; 
  top: 0; 
  left: 0; 
  min-width: 100%;
  min-height: 100%;
  background:url(gr/bg2.jpg);
  background-size:cover; 
  background-repeat:no-repeat;
}
#fo {
  margin: 130px 30px 30px 30px;
  padding: 30px 30px 30px 30px;
  background:url(gr/tlo1-85.png);
  background-size:cover; 
}
</style>
<?php
if ($this->p1=="wyloguj") {
	unset($_SESSION['login']);
	//$this->p1="";
	echo "<script language=\"JavaScript\" type=\"text/javascript\">";
	echo "location.href=\"".ADRES_STRONY."\";";
	echo "</script>";
}
if ($_POST["inputNazwa"]!="" and $_POST["inputHaslo"]!="") {
	$komentarz="Zła nazwa użytkownika lub hasło!";
	if($this->filtruj_string($_POST["inputNazwa"]) and $this->filtruj_string($_POST["inputHaslo"])) {
		$in=$_POST["inputNazwa"]; $ih=$_POST["inputHaslo"];
		$db = new mysqli(SER,UZY,HAS,BAZ); 
		if ($mysqli->connect_errno) { echo "Błąd połączenia z MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; }
		$result=$db->query("SET NAMES 'utf8'");
		$query = "SELECT * FROM uzytkownik WHERE login='".$in."' and haslo='".$ih."' and token='6645460511858306' and aktywny>0 LIMIT 1";
		$wynik = $db->query($query);
		$num = $wynik->num_rows;
		if ($num>0) {
			$rekord=$wynik->fetch_assoc();
			$_SESSION['login']=array(
			numer=>$rekord["nr"],
			nazwa=>$rekord["imie"]." ".$rekord["nazwisko"],
			nick=>$rekord["nazwa"],
			grupa=>$rekord["grupa"],
			email=>$rekord["email"]
			);
			$komentarz="Witaj ".$_SESSION['login']['nazwa'];
			echo "<script language=\"JavaScript\" type=\"text/javascript\">";
			echo "location.href=\"".ADRES_STRONY."\";";
			echo "</script>";

		} else {
			$db->close();
		}
	}
}
?>


<div id="bg">
<div class="row">
<div class="col-md-4 col-md-offset-4">
<div id="fo">
<form class="form-horizontal" action="<?php echo ADRES_STRONY; ?>" method="post">
  <div class="form-group">
    <div class="col-md-12">
      <input type="text" class="form-control" name="inputNazwa" id="inputNazwa" placeholder="Użytkownik">
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-12">
      <input type="password" class="form-control" name="inputHaslo" id="inputHaslo" placeholder="hasło">
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-12">
      <button type="submit" class="btn btn-primary" id="wyslij"> <span class="glyphicon glyphicon-send" aria-hidden="true"></span> &nbsp; Wyślij </button>
    </div>
  </div>
</form>
<div id="komentarz">
<?php echo $komentarz; ?>
</div>
</div>
</div>
</div>
<?php //$this->pokaz_zmienne(); ?>
</div>

