<div class="row" id="stopka">
	<!-- Wiersz 1 -->
	<div class="col-lg-10">
		<?php
		if ($_SESSION['login']['numer']>0) {
			echo "<span class=\"glyphicon glyphicon-user\" aria-hidden=\"true\"></span> ".$_SESSION['login']['nazwa'];
			} 
		?>
	</div>
    <div class="col-lg-2 text-right">
    <a href="http://nextserv.pl" target="_blank">nextserv.pl</a> © 2017
    </div>
</div>
</div> <!-- Koniec div id=fo z naglowka  -->
</div> <!-- Koniec div container z naglowka  -->
</div> <!-- Koniec div id=bg z naglowka  -->