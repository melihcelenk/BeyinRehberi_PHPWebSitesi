<?php 

//sunucu bilgileri gir
$kullaniciadi="u************";
$parola="***************";
$sunucu="mysql.***********.***";
$veritabani="u*************";

$baglan = mysqli_connect($sunucu,$kullaniciadi,$parola,$veritabani);

if (mysqli_connect_error())
  {
      die('error: '.mysqli_connect_error());
  }
?>