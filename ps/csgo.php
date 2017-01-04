<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Dokument bez tytułu</title>
</head>

<body>
<?php
$data=date("Y-m-d");
echo $data."<br>";
$data2=explode('-',$data);
echo "0=".$data2[0]."<br>";
echo "1=".$data2[1]."<br>";
echo "2=".$data2[2]."<br>";
?>
<h3>5 podstawowymi trybami gier</h3>
<ul>
  <li>  Classic Casual  </li>
  <li>Classic Competitive  </li>
  <li>Arms Race  </li>
  <li>Demolition    </li>
  <li>Deathmatch</li>
</ul>
<p>Ustawienia są w kliku gamemodes.txt - [katalog gry]\csgo\damemodes.txt (nic nie zmieniać w tym pliku!) 
Zmiany wprowadzamy w pliku gamemodes_server.txt - zmieniamy nazwę pliku gamemodes_server.txt.example</p>
<p>Podstawowa linia startowa:</p>
<p>srcds.exe -game csgo -console -usercon +game_type N +game_mode M +mapgroup [grupa_map] +map de_dust2</p>
<p>Zmienne N, M, [grupa_map]</p>
<table cellspacing="0" cellpadding="0">
  <tr>
    <th>NAZWA TYPU GRY</th>
    <th>N</th>
    <th>M</th>
  </tr>
  <tr>
    <td>Classic Casual</td>
    <td>0</td>
    <td>0</td>
  </tr>
  <tr>
    <td>Classic Competitive</td>
    <td>1</td>
    <td>0</td>
  </tr>
  <tr>
    <td>Arms Race</td>
    <td>0</td>
    <td>1</td>
  </tr>
  <tr>
    <td>Demolition</td>
    <td>1</td>
    <td>1</td>
  </tr>
  <tr>
    <td>Deathmatch</td>
    <td>1</td>
    <td>2</td>
  </tr>
  <br>
</table>
<h3>[grupa_map]</h3>
<p>W pliku gamemodes.txt jest 6 sekcji:</p>
<ul>
  <li>"gameTypes"</li>
  <li>"mapgroups"</li>
  <li>"maps"</li>
  <li>"botDifficulty"</li>
  <li>"mpSessionVisibility"</li>
  <li>"maptypes"</li>
</ul>
<p>Pierwsza sekcja "gameTypes" składa się kilku podsekcji. Nas interesuje ta ("mapgroupsMP") która mówi jakie grupy map, można odpalać w danym konkretnym trybie gry. Obrazuje to poniższa tabela.</p>
<table>
  <tbody>
    <tr>
      <th>TRYB GRY</th>
      <th>[GRUPA_MAP]</th>
    </tr>
    <tr>
      <td>Classic Casual</td>
      <td>mg_op_bravo, mg_bomb, mg_hostage</td>
    </tr>
    <tr>
      <td>Classic Competitive</td>
      <td>mg_op_bravo, mg_de_train, mg_de_dust2, mg_de_inferno, mg_de_mirage, mg_de_nuke, mg_de_dust, mg_de_aztec, mg_de_vertigo, mg_cs_militia, mg_cs_assault, mg_cs_italy, mg_cs_office</td>
    </tr>
    <tr>
      <td>Arms Race</td>
      <td>mg_armsrace</td>
    </tr>
    <tr>
      <td>Demolition</td>
      <td>mg_demolition</td>
    </tr>
    <tr>
      <td>Deathmatch</td>
      <td>mg_op_bravo, mg_deathmatch</td>
    </tr>
  </tbody>
</table>
<p>Skoro już wiemy jakie grupki mapek przypisane są do danego trybu gry, wypadałoby wiedzieć jakie mapki wchodzą w skład danej grupy map.
Dlatego przechodzimy do sekcji "mapgroups" w skład której wchodzą zdefiniowane grupy mapek (złożone z kilku mapek)</p>
<ul>
  <li>mg_op_bravo</li>
  <li>mg_hostage</li>
  <li>mg_bomb</li>
  <li>mg_deathmatch</li>
  <li>mg_armsrace</li>
  <li>mg_demolition</li>
</ul>
<p>Dostępne sa też grupy złożone z jednej mapki (tak wiem.., ale nie ja to wymyśliłem) Przykładowo są to:</p>
<ul>
  <li>mg_de_train - złożona z mapki de_train</li>
  <li>mg_de_dust - złożona z mapki de_dust</li>
  <li>mg_de_dust2 - złożona z mapki de_dust2</li>
  <li>mg_de_aztec - złożona z mapki de_aztec</li>
</ul>
<p>i wiele, wiele innych (lista dostępna w pliku).</p>
<p>Tabela pokazuje jakie mapy wchodząw skład podstawowych grup</p>
<table>
  <tbody>
    <tr>
      <th>[GRUPA_MAP]</th>
      <th>MAPKI</th>
    </tr>
    <tr>
      <td>mg_op_bravo</td>
      <td>de_overpass, de_cbble, de_cache, de_gwalior, de_ali, de_ruins, cs_agency, de_chinatown, cs_siege, de_seaside</td>
    </tr>
    <tr>
      <td>mg_hostage</td>
      <td>cs_militia, cs_assault, cs_office, cs_italy</td>
    </tr>
    <tr>
      <td>mg_bomb</td>
      <td>de_dust2, de_train, de_inferno, de_mirage, de_dust, de_aztec, de_nuke, de_vertigo</td>
    </tr>
    <tr>
      <td>mg_deathmatch</td>
      <td>de_dust2, de_train, de_inferno, de_mirage, de_mirage, de_dust, de_aztec, de_nuke, de_vertigo, cs_militia, cs_assault, cs_office, cs_italy, ar_monastery, ar_shoots, ar_baggage, de_lake, de_stmarc, de_sugarcane, de_bank, de_safehouse, de_shorttrain,</td>
    </tr>
    <tr>
      <td>mg_armsrace</td>
      <td>ar_monastery, ar_shoots, ar_baggage</td>
    </tr>
    <tr>
      <td>mg_demolition</td>
      <td>de_lake, de_stmarc, de_sugarcane, de_bank, de_safehouse,<br>
        de_shorttrain</td>
    </tr>
  </tbody>
</table>
<p>Przykładowy plik Classic Casual z ustawieniami domyślnymi:</p>
<p>srcds.exe -game csgo -console -usercon +game_type 0 +game_mode 0 +mapgroup mg_bomb +map de_dust</p>
<p>Przykładowy plik <strong>Classic Competitive</strong> z ustawieniami domyślnymi:</p>
<p>srcds.exe -game csgo -console -usercon +game_type 1 +game_mode 0 +mapgroup mg_de_nuke +map de_dust2</p>
<p>Linki:</p>
<h3>Tryby gry w Counter Strike: Global Offensive - ustawienia domyślne</h3>
<p><a href="http://g4g.pl/pl/podstawowe-tryby-gry-counter-strike-global-offensive">http://g4g.pl/pl/podstawowe-tryby-gry-counter-strike-global-offensive</a></p>
<h3>Modyfikacja domyślnych trybów gry serwera Counter Strike: Global Offensive</h3>
<p><a href="http://g4g.pl/pl/modyfikacja-domyślnych-trybów-gry-serwera-counter-strike-global-offensive">http://g4g.pl/pl/modyfikacja-domyślnych-trybów-gry-serwera-counter-strike-global-offensive</a></p>
<h3>Tworzenie listy map za pomocą Valve Workshop.</h3>
<p><a href="http://g4g.pl/pl/tworzenie-listy-map-za-pomoca-valve-workshop">http://g4g.pl/pl/tworzenie-listy-map-za-pomoca-valve-workshop</a></p>
<h3>Konfiguracja serwera CS:GO - stawiam serwer. SteamCMD.</h3>
<p><a href="http://g4g.pl/pl/konfiguracja-serwera-csgo-stawiam-serwer-steamcmd">http://g4g.pl/pl/konfiguracja-serwera-csgo-stawiam-serwer-steamcmd</a></p>
<p>&nbsp;</p>
</body>
</html>