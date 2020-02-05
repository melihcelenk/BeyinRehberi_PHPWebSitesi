<?php require('baglan.php'); 
require('auth.php');
?>
<?php 
	$sqlEtiketCek = "SELECT * FROM Etiketler";
	$sonucEtiket = mysqli_query($baglan,$sqlEtiketCek);
?>

<!DOCTYPE HTML>
<html>
<head><meta name="viewport" content="width=device-width"/>
<title>Beyin Rehberi - Gönderi Ekle</title>
<!-- STYLES & JQUERY 
================================================== -->
<link rel="stylesheet" type="text/css" href="/assets/css/style.css"/>
<link rel="stylesheet" type="text/css" href="/assets/css/icons.css"/>
<link rel="stylesheet" type="text/css" href="/assets/css/skinblue.css"/><!-- Change skin color here -->
<link rel="stylesheet" type="text/css" href="/assets/css/responsive.css"/>
<script src="/assets/js/jquery-1.9.0.min.js"></script><!-- scripts at the bottom of the document -->
</head>
<body>
<?php require('menu.php'); ?>
<?php require('header.php'); ?>


<?php 

	if (isset($_POST['gonder'])){
		
	
		$baslik = mysqli_real_escape_string($baglan,$_POST['gonderiBaslik']);
	
		$icerik = mysqli_real_escape_string($baglan,$_POST['gonderiIcerik']);
		
		$trn_date = date("Y-m-d H:i:s");
		
		$gonderenUyeNo = $_SESSION['userid'];
		
		$resim = $_FILES['resim']['name'];
		$resim_tmp = $_FILES['resim']['tmp_name'];	
		if(empty($resim)) { $resim="varsayilan.jpg"; }
		
		if (isset($_POST['etiketler'])) { $etiketler = $_POST['etiketler']; }
		if (!empty($etiketler)) {
			
			$gonderiEkleSorgu = "REPLACE INTO `Gonderiler` (`gonderiNo`, `baslik`, `icerik`, `gonderenUyeNo`, `gonderilmeZamani`, `gorunurluk`, `resim`) VALUES (NULL, '$baslik', '$icerik', '$gonderenUyeNo', '$trn_date', '1', '$resim')";
			$sonucGonderiEkle = mysqli_query($baglan,$gonderiEkleSorgu);
			move_uploaded_file($resim_tmp,"images/gonderiler/".$resim);
			
			if($sonucGonderiEkle){
			
				 $sqlGonderiCek = "SELECT * FROM Gonderiler WHERE gonderilmeZamani='$trn_date' AND gonderenUyeNo='$gonderenUyeNo' AND baslik='$baslik'";
				 $sonucGonderiCek = mysqli_query($baglan,$sqlGonderiCek);
				
				 if($sonucGonderiCek){
					 $satirGonderiCek = mysqli_fetch_array($sonucGonderiCek);
					 $gonderiNo = $satirGonderiCek['gonderiNo'];
					 foreach($etiketler as $etiketNumarasi){
						$sqlGonderiEtiketEkle = "REPLACE INTO `GonderiEtiket` (`etiketNo`, `gonderiNo`) VALUES ('$etiketNumarasi', '$gonderiNo')";
						$sonucGonderiEtiketEkle = mysqli_query($baglan, $sqlGonderiEtiketEkle);
						
					 }
				 }
				 //echo "Gönderi No: ".$satirGonderi['gonderiNo']."<br>".$satirGonderi['gonderilmeZamani'];
				 if($sonucGonderiEtiketEkle){
					echo "<div class='form'>
						<h3>Gönderi başarıyla eklendi.</h3>
						<br/>Gönderinizi görmek için <a href='/gonderidetay.php?id=$gonderiNo"."'>tıklayın</a></div>";
				 }
			}
		}
		else { echo "Lütfen bir etiket seçiniz!"; }
	}
?>
<!-- CONTENT
================================================== -->
<div class="grid">
		<div class="shadowundertop"></div>

		
		<div class="row space-top">
			<!-- CONTACT FORM -->
			<div class="c8 space-top">
				<h1 class="maintitle">
				<span><i class="icon-envelope-alt"></i> GÖNDERİ EKLE</span>
				</h1>
				<div class="wrapcontact">
					<div class="done">
						<div class="alert-box success ctextarea">
							 Gönderiniz başarıyla gönderildi. Teşekkür ederiz! <a href="" class="close">x</a>
						</div>
					</div>
					<form action="gonderiekle.php" method="POST" enctype="multipart/form-data">
						<div class="form">
							
							<label>Başlık</label>
							<input type="text" name="gonderiBaslik">
							
							<label>İçerik</label>
							<textarea class="ctextarea form-control" name="gonderiIcerik" rows="9"></textarea>
							
							<label> Resim </label>
							<input class="form-control" type="file" name="resim">
							
							<label> Etiketler </label>
							<?php 
								while($satirEtiket = mysqli_fetch_array($sonucEtiket)){ ?>
								
									<input type="checkbox" name="etiketler[]" value="<?php echo $satirEtiket['etiketNo']; ?>"> <?php echo $satirEtiket['etiketAdi']; ?><br>
							<?php
							}	
							?>
							
							
							
							<input type="submit" name="gonder" class="button" style="font-size:12px;" value="GÖNDER">
						</div>
					</form>
				</div>
			</div>
			<div class="c4 space-top">
				<h1 class="maintitle">
				<span><i class="icon-map-marker"></i> KURALLAR </span>
				</h1>
				<p>
					<ul>
						<li> Yasadışı içerik paylaşmak yasaktır.</li>
						<li> Aynı gönderiyi birden fazla kez paylaşmayınız. </li>
						<li> İlgili etiketleri seçmeye özen gösteriniz. </li>
					</ul>
				</p>
				<br/>

			</div>
		</div>
</div><!-- end grid -->


	<?php require('footer.php');  ?>

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

<!-- contact form -->
<script src="/assets/js/contact.js"></script>

</body>
</html>