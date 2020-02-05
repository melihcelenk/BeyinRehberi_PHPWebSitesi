<?php
require('baglan.php');
require('auth.php');
$gonderiNumarasi=$_GET['id'];

$uyeNo = $_SESSION['userid'];

?>
<?php
	$sqlGonderiCek = "SELECT * FROM Gonderiler WHERE gonderiNo = '$gonderiNumarasi' AND gorunurluk='1'";
	$sonucGonderi = mysqli_query($baglan,$sqlGonderiCek);
	$satirGonderi = mysqli_fetch_array($sonucGonderi);
?>
<?php 
	$sqlTumOylariCek = "SELECT * FROM Oylar WHERE verilenGonderiNo='$gonderiNumarasi'";
	$sqlIyiOylariCek = "SELECT * FROM Oylar WHERE verilenGonderiNo='$gonderiNumarasi' AND oyTipi='1'";
	$sonucTumOylariCek = mysqli_query($baglan,$sqlTumOylariCek);
	$sonucIyiOylariCek = mysqli_query($baglan,$sqlIyiOylariCek);
	
	if(mysqli_num_rows($sonucTumOylariCek) > 0){
		$oyVarMi = true;
		$oyOrani = ( mysqli_num_rows($sonucIyiOylariCek) / mysqli_num_rows($sonucTumOylariCek) ) * 100;
	}
	else {
		$oyVarMi = false;
	}
?>
<!DOCTYPE HTML>
<html>
<head><meta name="viewport" content="width=device-width"/>
<title>Beyin Rehberi - <?php echo $satirGonderi['baslik']; ?></title>
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

<?php 
$gonderenUyeNo = $satirGonderi['gonderenUyeNo'];
$sqlGonderidenUyeCek = "SELECT * FROM Uyeler WHERE uyeNo='$gonderenUyeNo'";
$sonucGonderidenUyeCek = mysqli_query($baglan,$sqlGonderidenUyeCek);
$satirGonderidenUyeCek = mysqli_fetch_array($sonucGonderidenUyeCek);
$sqlGonderidenEtiketCek = "SELECT * FROM GonderiEtiket WHERE gonderiNo='$gonderiNumarasi'";
$sonucGonderidenEtiketCek = mysqli_query($baglan,$sqlGonderidenEtiketCek);

$sqlOyCek = "SELECT * FROM Oylar WHERE verilenGonderiNo='$gonderiNumarasi' AND verenUyeNo='$uyeNo'";
$sonucOyCek = mysqli_query($baglan,$sqlOyCek);
if(mysqli_num_rows($sonucOyCek)>0){
	$satirOyCek = mysqli_fetch_array($sonucOyCek);
	$uyeninVerdigiOy = $satirOyCek['oyTipi'];
	
}

if (isset($_POST['gonder'])){
	if(isset($_POST['oy'])){
		$gonderilenOyTipi = $_POST['oy'];
		echo $_POST['oy']." seçildi.";
		$trn_date = date("Y-m-d H:i:s");
		$sqlOyEkle = "REPLACE INTO `Oylar` (`verilenGonderiNo`, `verenUyeNo`, `vermeZamani`, `oyTipi`) VALUES ('$gonderiNumarasi', '$uyeNo', '$trn_date', '$gonderilenOyTipi')";
		$sonucOyEkle = mysqli_query($baglan, $sqlOyEkle);
		if ($sonucOyEkle) { echo "Oyunuz kaydedildi."; echo("<script>location.href ='gonderidetay.php?id='.$gonderiNumarasi.';</script>"); }
	}
}

if (isset($_POST['cevapVer'])){
	
	$baslik = mysqli_real_escape_string($baglan,$_POST['gonderiBaslik']);
	$icerik = mysqli_real_escape_string($baglan,$_POST['gonderiIcerik']);
	$trn_date = date("Y-m-d H:i:s");
	$gonderenUyeNo = $_SESSION['userid'];
	

	$gonderiEkleSorgu = "REPLACE INTO `Gonderiler` (`gonderiNo`, `baslik`, `icerik`, `gonderenUyeNo`, `gonderilmeZamani`, `gorunurluk`, `resim`) VALUES (NULL, '$baslik', '$icerik', '$gonderenUyeNo', '$trn_date', '1', NULL)";
	$sonucGonderiEkle = mysqli_query($baglan,$gonderiEkleSorgu);	
	
	
	$eklenenGonderiNoCekSorgu = "SELECT `gonderiNo` FROM `Gonderiler` WHERE `Gonderiler`.`gonderenUyeNo` = '$uyeNo' AND `Gonderiler`.`gonderilmeZamani`='$trn_date'";
	$sonucEklenenGonderiNoCek = mysqli_query($baglan,$eklenenGonderiNoCekSorgu);
	$satirEklenenGonderiNoCek = mysqli_fetch_array($sonucEklenenGonderiNoCek);
	$eklenenGonderiNo = $satirEklenenGonderiNoCek['gonderiNo'];
	
	$cevapEkleSorgu = "REPLACE INTO `Cevaplar` (`gonderiNo`, `cevaplananGonderiNo`) VALUES ('$eklenenGonderiNo','$gonderiNumarasi')";
	$sonucCevapEkle = mysqli_query($baglan,$cevapEkleSorgu);
	if ($cevapEkleSorgu) { echo "Yorumunuz başarıyla eklendi."; }
	
	//$cevapCekSorgu = "SELECT gnd.gonderiNo, gnd.baslik, gnd.icerik, gnd.gonderenUyeNo, gnd.gonderilmeZamani, gnd.gorunurluk FROM `Gonderiler` gnd, `Cevaplar` cvp WHERE cvp.`cevaplananGonderiNo` = '$gonderiNumarasi' "; //AND gnd.`gonderiNo`=$gonderiNumarasi

}

$cevapCekSorgu = "SELECT * from Cevaplar WHERE cevaplananGonderiNo = '$gonderiNumarasi'";
$sonucCevapCek = mysqli_query($baglan,$cevapCekSorgu);
?>


<!-- CONTENT
================================================== -->
<div class="grid">
		<div class="shadowundertop">
		</div>
		<div class="row">		

			<!-- MAIN CONTENT -->
			<div class="c9">
				<h1 class="maintitle space-top">
				<span><?php echo $satirGonderi['baslik']  ?></span>
				</h1>
				<img src="/images/gonderiler/<?php echo $satirGonderi['resim']; ?>" alt="">
				<p>
					<span class="dropcap"> <?php $metin = $satirGonderi['icerik']; $basHarf=substr($metin,0,1); echo $basHarf; ?></span><?php $devam=substr($metin,1,strlen($metin)-1); echo $devam;  ?>
				</p>
				<br>
				<h1 class="maintitle">
				<span><i class="icon-envelope-alt"></i>YORUM EKLE</span>
				</h1>
				<div class="wrapcontact">
					<div class="done">
						<div class="alert-box success ctextarea">
							 Cevabınız başarıyla gönderildi. Teşekkür ederiz! <a href="" class="close">x</a>
						</div>
					</div>
					<form action="gonderidetay.php?id=<?php echo $gonderiNumarasi; ?>" method="POST" enctype="multipart/form-data">
						<div class="form">
							
							<label>Başlık</label>
							<input type="text" name="gonderiBaslik">
							
							<label>İçerik</label>
							<textarea class="ctextarea form-control" name="gonderiIcerik" rows="9"></textarea>
							
							<input type="submit" name="cevapVer" class="button" style="font-size:12px;" value="GÖNDER">
						</div>
					</form>
				</div>
				<h1 class="maintitle space-top">
					<span>YORUMLAR</span>
				</h1>
				<?php while($satirCevapCek=mysqli_fetch_array($sonucCevapCek)){
					
					$cevabinGonderiNumarasi = $satirCevapCek['gonderiNo'];
					$sqlCevapGonderileriniGetir = "SELECT gnd.gonderiNo, gnd.baslik, gnd.icerik, gnd.gonderenUyeNo, gnd.gonderilmeZamani, gnd.gorunurluk FROM `Gonderiler` gnd WHERE gnd.GonderiNo = '$cevabinGonderiNumarasi' ";
					$sonucCevapGonderileriniGetir = mysqli_query($baglan,$sqlCevapGonderileriniGetir);
					while($satirCevapGonderileriniGetir = mysqli_fetch_array($sonucCevapGonderileriniGetir)){
						$cevapGonderenUyeNo = $satirCevapGonderileriniGetir['gonderenUyeNo'];
						$sqlCevapVerenUyeyiGetir = "SELECT kullaniciAdi FROM Uyeler WHERE uyeNo='$cevapGonderenUyeNo'";
						$sorguCevapVerenUyeyiGetir = mysqli_query($baglan,$sqlCevapVerenUyeyiGetir);
						$satirCevapVerenUyeyiGetir = mysqli_fetch_array($sorguCevapVerenUyeyiGetir);
						$cevapVerenUyeKullaniciAdi = $satirCevapVerenUyeyiGetir['kullaniciAdi'];
							echo "<b>Gönderen:</b>".$cevapVerenUyeKullaniciAdi."<br>";
							echo "<b>Başlık:</b>".$satirCevapGonderileriniGetir['baslik']."<br>";
							echo "<b>İçerik:</b>".$satirCevapGonderileriniGetir['icerik']."<br><br>";
						
					}
				}
				?>
				
			</div><!-- end main content -->
			
			
			

			<!-- SIDEBAR -->	

			<div class="vuzz-pricing-table c3">
					<div class="vuzz-pricing popular">
						<div class="vuzz-pricing-header">
							<h5>Başlık: <?php echo $satirGonderi['baslik']; ?></h5>
				
							<div class="vuzz-pricing-cost">

								
							</div>
							<div class="vuzz-pricing-per">
								
							</div>
						</div>
						<div class="c12">
							<ul id="skill">

								<li><span class="bar progressblue" style="width:<?php if($oyVarMi) { echo $oyOrani; } else { echo "0";} ?>%;"></span>
								<h3> <?php if($oyVarMi) { echo " Beğeni ".$oyOrani."%"; } else { echo "Oy Verilmemiş";}?></h3>
								</li>
							</ul>
						</div>			
						<div class="vuzz-pricing-content">
							<ul>
								<li><b>Gönderilme Tarihi:</b> <?php echo $satirGonderi['gonderilmeZamani']; ?></li>
								<li><b>Gönderen Üye:</b> <?php echo $satirGonderidenUyeCek['kullaniciAdi']; ?></li>
								<li><b>Etiketler:</b> <?php 
								while($satirGonderidenEtiketCek = mysqli_fetch_array($sonucGonderidenEtiketCek)){
									$etiketNumarasi = $satirGonderidenEtiketCek['etiketNo'];
									$sqlGonderininEtiketAdiniCek = "SELECT * FROM Etiketler WHERE etiketNo='$etiketNumarasi'";
									$sonucGonderininEtiketAdiniCek = mysqli_query($baglan, $sqlGonderininEtiketAdiniCek);
									$satirGonderininEtiketAdiniCek = mysqli_fetch_array($sonucGonderininEtiketAdiniCek);
									$etiketAdi = $satirGonderininEtiketAdiniCek['etiketAdi'];
									echo $etiketAdi." "; 
								} ?>
		
		

								</li>
								
								<li>
									<form action="gonderidetay.php?id=<?php echo $gonderiNumarasi; ?>" method="POST" enctype="multipart/form-data">
										<div class="form">
											<div class="c4">
												<label class="radio-inline">
												<input type="radio" 
													name="oy" 
													value="1" 
													<?php if(mysqli_num_rows($sonucOyCek)>0){ if ($uyeninVerdigiOy == 1) { echo 'checked'; } } ?> 
												> İyi </label>
											</div>
											<div class="c4">
												<label class="radio-inline">
												<input type="radio" 
													name="oy" 
													value="0" 
													<?php if(mysqli_num_rows($sonucOyCek)>0){ if ($uyeninVerdigiOy == 0) { echo 'checked'; } } ?> 
												> Kötü </label>
											</div>
											<div class="c4">
												<input type="submit" name="gonder" class="button" style="font-size:12px;" value="Oy Ver">
											</div>	


										</div>
									</form>	
								</li>
								<li>
																
								</li>
	
								
								
							</ul>
						</div>
					</div>
				</div>
			
			
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