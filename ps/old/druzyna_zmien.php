<?php
	// popraw wybrany rekord
	$zap = "select * from `stoczniowiec_baza`.`".$tabela."` where `".$tabela."`.`nr`=".$_GET["r"]." limit 1;";
	$wyn = mysql_query($zap,$kon);
	$wiersz=mysql_fetch_array($wyn);
?>	
<div class="alert alert-success"> <i class="icon-list"></i> Zmiana danych wpisu nr: <?php echo $_GET["r"] ?></div>
<form action="index.php<?php echo linki('',0); ?>a=3&r=<?php echo $_GET["r"]; ?>" method="post" id="akt_zmi" accept-charset="UTF-8">
<div class="alert alert-block">
<!-- pole numer -->
<input type="text" id="nr" name="nr" value="<?php echo $wiersz["nr"]; ?>" readonly> <i class="icon-info-sign"></i>  Numer <i class="icon-lock"></i> Pole tylko do odczytu. 
<!-- pole sekcja 
<br /><input type="text" id="sekcja" name="sekcja" value="<?php echo $wiersz["sekcja"]; ?>">
<i class="icon-info-sign"></i>  Sekcja
<br />-->
<?php
	echo "<br /><select name=\"sekcja\" size=\"1\">";
	$zap = "select * from `stoczniowiec_baza`.`sekcja` where aktywny>0 order by nr";
	$wyn_sekcja = mysql_query($zap,$kon);
	$num_sekcja = mysql_num_rows($wyn_sekcja);
	for ($i=0; $i<$num_sekcja; $i++) {
		$wiersz_sekcja=mysql_fetch_array($wyn_sekcja);
		if ($wiersz_sekcja["nr"]==$wiersz["sekcja"])
			{ echo "<option value=\"".$wiersz_sekcja["nr"]."\" selected>".$wiersz_sekcja["nazwa"]."</option>"; }
		else
			{ echo "<option value=\"".$wiersz_sekcja["nr"]."\">".$wiersz_sekcja["nazwa"]."</option>";  } 
	}
	echo "</select>";
?> 
<i class="icon-info-sign"></i> Sekcja.
<!-- pole nazwa -->
<br /><input type="text" id="nazwa" name="nazwa" value="<?php echo $wiersz["nazwa"]; ?>">
<i class="icon-info-sign"></i>  Nazwa
<!-- pole logo -->
<br /><input type="text" id="logo" name="logo" value="<?php echo $wiersz["logo"]; ?>">
<i class="icon-info-sign"></i>  Graficzne logo sekcji
<!-- pole opis -->
<br />
<i class="icon-circle-arrow-down"></i> <i class="icon-info-sign"></i>  Opis sekcji 
<textarea name="opis" id="opis" rows="2" cols="80">
<?php echo $wiersz["opis"]; ?>
</textarea>
<script>
CKEDITOR.replace( 'opis' );
</script>
<br />
<button type="submit" class="btn btn-primary">  <i class="icon-check icon-white"></i>  Zapisz zmiany </button>
</form>