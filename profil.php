<?php
require('baglan.php');

$uyeNo = $_GET['id'];

?>
<?php
	$sqlSonGonderiCek = "SELECT * FROM Gonderiler WHERE gorunurluk='1' AND gonderenUyeNo='$uyeNo' AND resim IS NOT NULL ORDER BY gonderiNo DESC LIMIT 1";
	$sonucSonGonderi = mysqli_query($baglan,$sqlSonGonderiCek);
	$satirSonGonderi = mysqli_fetch_array($sonucSonGonderi);
?>
<?php 
	$sqlUyeBilgiCek = "SELECT * FROM Uyeler WHERE uyeNo='$uyeNo'";
	$sonucUyeBilgiCek = mysqli_query($baglan, $sqlUyeBilgiCek);
	$satirUyeBilgiCek = mysqli_fetch_array($sonucUyeBilgiCek);
?>
<?php
	$sqlProfilUyeEtiketCek = "SELECT * FROM UyeEtiket WHERE uyeNo='$uyeNo'";
	$sonucProfilUyeEtiketCek = mysqli_query($baglan, $sqlProfilUyeEtiketCek);

?>
<!DOCTYPE HTML>
<html>
<head><meta name="viewport" content="width=device-width"/>
<title>Beyin Rehberi - <?php echo $satirUyeBilgiCek['kullaniciAdi']; ?></title>
<!-- STYLES & JQUERY 
================================================== -->
<link rel="stylesheet" type="text/css" href="/assets/css/style.css"/>
<link rel="stylesheet" type="text/css" href="/assets/css/icons.css"/>
<link rel="stylesheet" type="text/css" href="/assets/css/skinblue.css"/><!-- change skin color -->
<link rel="stylesheet" type="text/css" href="/assets/css/responsive.css"/>
<script src="/assets/js/jquery-1.9.0.min.js"></script><!-- the rest of the scripts at the bottom of the document -->
</head>
<body>
<?php require('menu.php'); ?>

<?php require('header.php'); ?>


<!-- CONTENT
================================================== -->
<div class="grid">
		<div class="shadowundertop">
		</div>
		<div class="row">		

			<!-- SIDEBAR -->	

			<div class="vuzz-pricing-table c6">
				<h1 class="maintitle space-top">
					<span>Profil</span>
					

				</h1>
				<a href="profilguncelle.php?id='.$satir['uyeNo'].'" >Güncelle</a>
				<div class="vuzz-pricing popular">
					<div class="vuzz-pricing-header">
						<h5>Üye: <?php echo $satirUyeBilgiCek['kullaniciAdi']; ?></h5>
			
						<div class="vuzz-pricing-cost">

							
						</div>
						<div class="vuzz-pricing-per">
							
						</div>
					</div>
					<div class="c12">
						<ul id="skill">

							<li><span class="bar progressblue" style="width:<?php  echo "0"; ?>%;"></span>
							<h3> <?php echo "Oy Verilmemiş"; ?></h3>
							</li>
						</ul>
					</div>			
					<div class="vuzz-pricing-content">
						<ul>
							<li><b>Kayıt Tarihi: </b> <?php echo $satirUyeBilgiCek['kayitTarihi']; ?></li>
							<li><b>Ad Soyad: </b> <?php echo $satirUyeBilgiCek['ad']." ".$satirUyeBilgiCek['soyad']; ?></li>
							<li><b>Meslek: </b> <?php echo $satirUyeBilgiCek['meslek']; ?> </li>
							<li><b>Etiketler: </b> 
							<?php
								while($satirProfilUyeEtiketCek = mysqli_fetch_array($sonucProfilUyeEtiketCek)){
									$etiketNumarasi = $satirProfilUyeEtiketCek['etiketNo'];
									$sqlEtiketCek = "SELECT * FROM Etiketler WHERE etiketNo='$etiketNumarasi'";
									$sonucEtiketCek = mysqli_query($baglan, $sqlEtiketCek);
									$satirEtiketCek = mysqli_fetch_array($sonucEtiketCek);
									echo $satirEtiketCek['etiketAdi']." ";
								}
							
							?>
							</li>
						</ul>
					</div>

					
				</div>
			</div>
			<!-- MAIN CONTENT -->
			<div class="c6">
				<h1 class="maintitle space-top">
					<span>Son Gönderi</span>
				</h1>
				<h2> <?php echo $satirSonGonderi['baslik']  ?> </h2>
				<img src="/images/gonderiler/<?php echo $satirSonGonderi['resim']; ?>" alt="">
				<p>
					<span class="dropcap"> <?php $sonGndNo = $satirSonGonderi['gonderiNo']; $metin = $satirSonGonderi['icerik']; $basHarf=substr($metin,0,1); echo $basHarf; ?></span><?php $devam=substr($metin,1,strlen($metin)-1); echo $devam."<a href='/gonderidetay.php?id=".$sonGndNo."'> [Gönderiyi Aç] </a>"; ?>
				</p>
			
			</div><!-- end main content -->			
		</div>
</div><!-- end grid -->

<?php require('footer.php'); ?>


<!-- JAVASCRIPTS
================================================== -->
<!-- all -->
<script src="/assets/js/modernizr-latest.js"></script>

<!-- menu & scroll to top -->
<script src="/assets/js/common.js"></script>

<!-- cycle -->
<script src="/assets/js/jquery.cycle.js"></script>

<!-- twitter -->
<script src="/assets/js/jquery.tweet.js"></script>

</body>
</html>