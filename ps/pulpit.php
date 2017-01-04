<?php $par=$this->pobierzParametry(3); ?>

<!--
CSS
-->
<style type="text/css">
.stylsprzedactive {
  width:100px;
  height:100px;
  background-color: <?php echo $par["sprzedaz_kolor_active"];?>;
  color:#fff;
  padding:5px 5px 5px 5px;
  margin:5px 5px 5px 5px;
  float:left;
  background-repeat:no-repeat;
  background-position:bottom right;	
}
.stylsprzed {
  width:100px;
  height:100px;
  background-color: <?php echo $par["sprzedaz_kolor_box"];?>;
  color:#fff;
  padding:5px 5px 5px 5px;
  margin:5px 5px 5px 5px;
  float:left;
  background-repeat:no-repeat;
  background-position:bottom right;	
}
.stylfinactive {
  width:100px;
  height:100px;
  background-color: <?php echo $par["finanse_kolor_active"];?>;
  color:#fff;
  padding:5px 5px 5px 5px;
  margin:5px 5px 5px 5px;
  float:left;
  background-repeat:no-repeat;
  background-position:bottom right;	
}
.stylfin {
  width:100px;
  height:100px;
  background-color: <?php echo $par["finanse_kolor_box"];?>;
  color:#fff;
  padding:5px 5px 5px 5px;
  margin:5px 5px 5px 5px;
  float:left;
  background-repeat:no-repeat;
  background-position:bottom right;	
}
.stylmagactive {
  width:100px;
  height:100px;
  background-color: <?php echo $par["magazyn_kolor_active"];?>;
  color:#fff;
  padding:5px 5px 5px 5px;
  margin:5px 5px 5px 5px;
  float:left;
  background-repeat:no-repeat;
  background-position:bottom right;	
}
.stylmag {
  width:100px;
  height:100px;
  background-color: <?php echo $par["magazyn_kolor_box"];?>;
  color:#fff;
  padding:5px 5px 5px 5px;
  margin:5px 5px 5px 5px;
  float:left;
  background-repeat:no-repeat;
  background-position:bottom right;	
}
.styladmactive {
  width:100px;
  height:100px;
  background-color: <?php echo $par["administracja_kolor_active"];?>;
  color:#fff;
  padding:5px 5px 5px 5px;
  margin:5px 5px 5px 5px;
  float:left;
  background-repeat:no-repeat;
  background-position:bottom right;	
}
.styladm {
  width:100px;
  height:100px;
  background-color: <?php echo $par["administracja_kolor_box"];?>;
  color:#fff;
  padding:5px 5px 5px 5px;
  margin:5px 5px 5px 5px;
  float:left;
  background-repeat:no-repeat;
  background-position:bottom right;	
}
</style>



<!--
Sprzedaż
-->
<div class="row" style="background-image:url(<?php echo ADRES_STRONY.$par["sprzedaz_tlo"];?>); margin:5px 0px 0px 0px;">
<div class="col-md-12">
    <div style="color:#FFF; padding:5px 5px 5px 5px; font-size:20px; font-weight:700"><span class="glyphicon <?php echo $par["sprzedaz_ikona"]; ?>" aria-hidden="true"></span> SPRZEDAŻ</div>
    <div class="stylsprzed" style="background-image:url(<?php echo ADRES_STRONY;?>/gr/izle5.png);" onMouseOver="this.className='stylsprzedactive'" onMouseOut="this.className='stylsprzed'" onclick="document.location='<?php echo ADRES_STRONY;?>/zlecenia'">
    Zlecenia
    </div>
    <div class="stylsprzed" style="background-image:url(<?php echo ADRES_STRONY;?>/gr/ipar5.png);" onMouseOver="this.className='stylsprzedactive'" onMouseOut="this.className='stylsprzed'" onclick="document.location='<?php echo ADRES_STRONY;?>/paragony'">
    Paragony
    </div>
    <div class="stylsprzed" style="background-image:url(<?php echo ADRES_STRONY;?>/gr/ifak5.png);" onMouseOver="this.className='stylsprzedactive'" onMouseOut="this.className='stylsprzed'" onclick="document.location='<?php echo ADRES_STRONY;?>/faktury'">
    Faktury
    </div>
    <div class="stylsprzed" style="background-image:url(<?php echo ADRES_STRONY;?>/gr/izle5.png);" onMouseOver="this.className='stylsprzedactive'" onMouseOut="this.className='stylsprzed'" onclick="document.location='<?php echo ADRES_STRONY;?>/faktury_korygujace'">
    Faktury korygujące
    </div>
    <div class="stylsprzed" style="background-image:url(<?php echo ADRES_STRONY;?>/gr/ikli5.png);" onMouseOver="this.className='stylsprzedactive'" onMouseOut="this.className='stylsprzed'" onclick="document.location='<?php echo ADRES_STRONY;?>/klienci'">
    Klienci
    </div>
</div>    
</div>
<!--
Finanse
-->
<div class="row" style="background-image:url(<?php echo ADRES_STRONY;?><?php echo $par["finanse_tlo"];?>); margin:5px 0px 0px 0px;">
<div class="col-md-12">
    <div style="color:#FFF; padding:5px 5px 5px 5px; font-size:20px; font-weight:700"><span class="glyphicon <?php echo $par["finanse_ikona"]; ?>" aria-hidden="true"></span> FINANSE</div>
    <div class="stylfin" style="background-image:url(<?php echo ADRES_STRONY;?>/gr/izle5.png);" onMouseOver="this.className='stylfinactive'" onMouseOut="this.className='stylfin'" onclick="document.location='<?php echo ADRES_STRONY;?>/raport_kasowy'">
    Raport kasowy
    </div>
    <div class="stylfin" style="background-image:url(<?php echo ADRES_STRONY;?>/gr/ipar5.png);" onMouseOver="this.className='stylfinactive'" onMouseOut="this.className='stylfin'" onclick="document.location='<?php echo ADRES_STRONY;?>/wydatki_z_kasy'">
    Wydatki z kasy
    </div>
    <div class="stylfin" style="background-image:url(<?php echo ADRES_STRONY;?>/gr/ifak5.png);" onMouseOver="this.className='stylfinactive'" onMouseOut="this.className='stylfin'" onclick="document.location='<?php echo ADRES_STRONY;?>/przelewy'">
    Przelewy
    </div>
     
</div>    
</div>
<!--
Magazyn
-->
<div class="row" style="background-image:url(<?php echo ADRES_STRONY;?><?php echo $par["magazyn_tlo"];?>); margin:5px 0px 0px 0px;">
<div class="col-md-12">
    <div style="color:#FFF; padding:5px 5px 5px 5px; font-size:20px; font-weight:700"><span class="glyphicon <?php echo $par["magazyn_ikona"]; ?>" aria-hidden="true"></span> Magazyn</div>
    <div  class="stylmag" style="background-image:url(<?php echo ADRES_STRONY;?>/gr/izle5.png);" onMouseOver="this.className='stylmagactive'" onMouseOut="this.className='stylmag'" onclick="document.location='<?php echo ADRES_STRONY;?>/stan_magazynowy'">
	Stan magazynowy
    </div>
    <div  class="stylmag" style="background-image:url(<?php echo ADRES_STRONY;?>/gr/ipar5.png);" onMouseOver="this.className='stylmagactive'" onMouseOut="this.className='stylmag'" onclick="document.location='<?php echo ADRES_STRONY;?>/dostawa_towaru'">
    Dostawa towaru
    </div>
     <div  class="stylmag" style="background-image:url(<?php echo ADRES_STRONY;?>/gr/ifak5.png);" onMouseOver="this.className='stylmagactive'" onMouseOut="this.className='stylmag'" onclick="document.location='<?php echo ADRES_STRONY;?>/zamowienie_towaru'">
    Zamówienie towaru
    </div>
    <div  class="stylmag" style="background-image:url(<?php echo ADRES_STRONY;?>/gr/ifak5.png);" onMouseOver="this.className='stylmagactive'" onMouseOut="this.className='stylmag'" onclick="document.location='<?php echo ADRES_STRONY;?>/zwrot_do_dostawcy'">
    Zwrot do dostawcy
    </div>
    <div  class="stylmag" style="background-image:url(<?php echo ADRES_STRONY;?>/gr/ifak5.png);" onMouseOver="this.className='stylmagactive'" onMouseOut="this.className='stylmag'" onclick="document.location='<?php echo ADRES_STRONY;?>/przesuniecie_magazynowe'">
    Przesunięcie magazynowe
    </div> 
    <div  class="stylmag" style="background-image:url(<?php echo ADRES_STRONY;?>/gr/ifak5.png);" onMouseOver="this.className='stylmagactive'" onMouseOut="this.className='stylmag'" onclick="document.location='<?php echo ADRES_STRONY;?>/asortyment'">
    Asortyment
    </div> 
    <div  class="stylmag" style="background-image:url(<?php echo ADRES_STRONY;?>/gr/ifak5.png);" onMouseOver="this.className='stylmagactive'" onMouseOut="this.className='stylmag'" onclick="document.location='<?php echo ADRES_STRONY;?>/grupy_towarowe'">
    Grupy towarowe
    </div> 
</div>    
</div>
<!--
Administracja
-->

<div class="row" style=" background-image:url(<?php echo ADRES_STRONY;?><?php echo $par["administracja_tlo"];?>); margin:5px 0px 0px 0px;">
<div class="col-md-12">
    <div style="color:#FFF; padding:5px 5px 5px 5px; font-size:20px; font-weight:700"><span class="glyphicon <?php echo $par["administracja_ikona"]; ?>" aria-hidden="true"></span> ADMINISTRACJA</div>
    <div  class="styladm" style="background-image:url(<?php echo ADRES_STRONY;?>/gr/ikli5.png);" onMouseOver="this.className='styladmactive'" onMouseOut="this.className='styladm'" onclick="document.location='<?php echo ADRES_STRONY;?>/zakonczenie_dnia'">
    Zakończenie dnia
    </div>
    <div  class="styladm" style="background-image:url(<?php echo ADRES_STRONY;?>/gr/ikli5.png);" onMouseOver="this.className='styladmactive'" onMouseOut="this.className='styladm'" onclick="document.location='<?php echo ADRES_STRONY;?>/kopiarki'">
    Kopiarki
    </div>
    <div  class="styladm" style="background-image:url(<?php echo ADRES_STRONY;?>/gr/ikli5.png);" onMouseOver="this.className='styladmactive'" onMouseOut="this.className='styladm'" onclick="document.location='<?php echo ADRES_STRONY;?>/raporty'">
    Raporty
    </div>
    <div  class="styladm" style="background-image:url(<?php echo ADRES_STRONY;?>/gr/ikli5.png);" onMouseOver="this.className='styladmactive'" onMouseOut="this.className='styladm'" onclick="document.location='<?php echo ADRES_STRONY;?>/uzytkownicy'">
    Użytkownicy
    </div>
    <div class="styladm" style="background-image:url(<?php echo ADRES_STRONY;?>/gr/ikli5.png);" onMouseOver="this.className='styladmactive'" onMouseOut="this.className='styladm'" onclick="document.location='<?php echo ADRES_STRONY;?>/uprawnienia'">
    Uprawnienia
    </div>
	
     
</div>    
</div>

<!--
<p>http://pl.freepik.com/darmowe-ikony/edukacja</p>
-->
