<div class="alert alert-success"> <i class="icon-list"></i> Dodaj nowy wpis </div>
<form action="index.php<?php echo linki('',0); ?>a=1" method="post" id="waz_dod" accept-charset="UTF-8">
<div class="alert alert-block">
<!-- pole sekcja -->
<?php
	echo "<br /><select name=\"sekcja\" size=\"1\">";
	$zap = "select * from `stoczniowiec_baza`.`sekcja` where aktywny>0 order by nr";
	$wyn_sekcja = mysql_query($zap,$kon);
	$num_sekcja = mysql_num_rows($wyn_sekcja);
	for ($i=0; $i<$num_sekcja; $i++) {
		$wiersz_sekcja=mysql_fetch_array($wyn_sekcja);
		if ($wiersz_sekcja["nr"]==2)
			{ echo "<option value=\"".$wiersz_sekcja["nr"]."\" selected>".$wiersz_sekcja["nazwa"]."</option>"; }
		else
			{ echo "<option value=\"".$wiersz_sekcja["nr"]."\">".$wiersz_sekcja["nazwa"]."</option>";  } 
	}
	echo "</select>";
?> <i class="icon-info-sign"></i> Sekcja.
<!-- pole nazwa -->
<br /><input type="text" id="nazwa" name="nazwa" value="">
<i class="icon-info-sign"></i>  Nazwa drużyny 
<!-- pole logo -->
<br /><input type="text" id="logo" name="logo" value="">
<i class="icon-info-sign"></i>  graficzne logo drużyny 
<!-- pole opis -->
<br />
<i class="icon-circle-arrow-down"></i> <i class="icon-info-sign"></i>  Opis drużyny 
<textarea name="opis" id="opis" rows="2" cols="80">
</textarea>
<script>
CKEDITOR.replace( 'opis' );
</script>
</div>
<br />
<button type="submit" class="btn btn-primary"><i class="icon-check icon-white"></i> Zapisz nowy wpis </button>
</form>
