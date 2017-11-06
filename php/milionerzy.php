<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta charset="utf-8">
</head>
<body>
<div class="container">
<?php
include 'Pytanie.class.php';
include 'DodajPytania.php';
include 'wygrane.php';
if(!isset($_REQUEST['poziom'])) {
   $poziom = 1; //nowa gra
   $numerPytania = rand(0,2);
}
else $poziom = $_REQUEST['poziom'];

if (isset($_REQUEST['odpowiedz'])) {
 //udzielono odpowiedzi
 $odpowiedz = $_REQUEST['odpowiedz'];
 $numerPytania = $_REQUEST['numerPytania'];
 if($pytania[$numerPytania]->sprawdzOdpowiedz($_REQUEST['odpowiedz'])) {
    //prawidłowa odpowiedz
    $poziom++;
    //losuj nastepne
    $numerPytania = rand(0,2);
  }
  else {
    //przegrana - progi
    if($poziom > 2 && $poziom <= 7) {
     echo 'Wygrałeś/aś 1 000 zł<br>';
    } else if($poziom > 7) {
      echo 'Wygrałeś/aś 40 000 zł<br>';
    }
    exit();
  }
} elseif (isset($_REQUEST['kolo'])) {
  //wybrano kolo ratunkowe
  switch ($_REQUEST['kolo']) {
    case 'polnapol':
      $pytania[$_REQUEST['numerPytania']]->polNaPol();
      break;
    case 'publicznosc':
      $pytania[$_REQUEST['numerPytania']]->publicznosc();
      break;
  }
  //powtorz pytanie zamiast losowego
  $numerPytania = $_REQUEST['numerPytania'];
}

echo '<h1>Pytanie za '.$wygrane[$poziom].' zł</h1>';
echo '<form action="milionerzy.php" method="get">';
echo $pytania[$numerPytania]->wyswietlPytanie();
echo '<input type="hidden" name="numerPytania" value="'.$numerPytania.'">';
echo '<input type="hidden" name="poziom" value="'.$poziom.'">';
echo '<input type="submit" value="Definitywnie">';
echo '</form>';
echo '<a href="milionerzy.php?kolo=polnapol&numerPytania='.$numerPytania.'&poziom='.$poziom.'">Pół na pół</a><br>';
echo '<a href="milionerzy.php?kolo=publicznosc&numerPytania='.$numerPytania.'&poziom='.$poziom.'">Publicznosc</a><br>';
echo '<pre>';
// var_dump($pytania);
?>
</div>
</body>
</html>
