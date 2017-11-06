<?php
class Pytanie
{
 private $tresc = '';
 private $odpowiedzi = Array();
 private $prawidlowaOdpowiedz = '';

 function ustawTresc($t)
 {
   $this->tresc = $t;
  }
  function dodajOdpowiedz($i,$o)
  {
    $this->odpowiedzi[$i] = $o;
  }
  function wyswietlPytanie()
  {
    echo '<div class="siema"><h3>'.$this->tresc.'</div></h3>';
    foreach ($this->odpowiedzi as $indeks => $odpowiedz) {
      echo '<div class="witam">';
      echo '<input type="radio" name="odpowiedz" id="radio_'.$indeks.'" value="'.$indeks.'" required>
              <label for="radio_'.$indeks.'">'.$odpowiedz.'</label><br>';
      echo '</div>';
    }
  }
  function polNaPol(){
    $klucze = array_keys($this->odpowiedzi);
    while(count($this->odpowiedzi) > 2){
      $o = rand(0,3);
      $o = $klucze[$o];
      if($o != $this->prawidlowaOdpowiedz) {
        unset($this->odpowiedzi[$o]);
      }
    }
  }
  function publicznosc(){
    echo $this->odpowiedzi[$this->prawidlowaOdpowiedz].'25%';
  }
  function poprawnaOdpowiedz($o)
  {
    $this->prawidlowaOdpowiedz = $o;
  }
  function sprawdzOdpowiedz($o)
  {
    if($this->prawidlowaOdpowiedz == $o) return true;
    else return false;
  }
}
?>
