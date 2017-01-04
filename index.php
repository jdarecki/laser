<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?php echo ADRES_STRONY; ?>/gr/logoEGC32kolo.png"; type="image/png">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<?php
	include('parametry.php');
	include('classes.php');
	$strona = new Strona(); 
	if(!$strona->filtruj_adres()) { $strona->tresc=$strona->strona_bledu; }
	if($strona->slowa_kluczowe) { echo "<meta name='keywords' content='".$strona->slowa_kluczowe."'>"; }
	if($strona->opis_strony) { echo "<meta name='description' content='".$strona->opis_strony."'>"; }
	echo "<title>".$strona->tytul_strony."</title>";
	?>

    <!-- Bootstrap -->
    <link href="<?php echo ADRES_STRONY; ?>/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo ADRES_STRONY; ?>/css/bootstrap-theme.min.css" rel="stylesheet">
	<!-- Base MasterSlider style sheet -->
	<link rel="stylesheet" href="<?php echo ADRES_STRONY; ?>/masterslider/style/masterslider.css">
	<!-- Master Slider Skin -->
	<link href="<?php echo ADRES_STRONY; ?>/masterslider/skins/default/style.css" rel='stylesheet' type='text/css'>
	<!-- Custom style -->
	<link href="<?php echo ADRES_STRONY; ?>/css/mycss.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	<?php $strona->pokazStrone(); ?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo ADRES_STRONY; ?>/js/bootstrap.min.js"></script>
	<!-- Master Slider -->
	<script src="<?php echo ADRES_STRONY; ?>/masterslider/masterslider.min.js"></script>
	<!-- Masterslider -->
	<script type="text/javascript">
		var slider = new MasterSlider();
		// adds Arrows navigation control to the slider.
		slider.control('arrows');
		slider.control('timebar' , {insertTo:'#masterslider'});
		slider.control('bullets');
		slider.setup('masterslider' , {
			 width:1170,    // slider standard width
			 height:300,   // slider standard height
			 space:1,
			 layout:'fillwidth',
			 loop:true,
			 preload:0,
			 autoplay:true
		});
	</script>
  </body>
</html>