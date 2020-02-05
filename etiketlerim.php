<?php require('baglan.php'); 
	$uyeNo = 41;
?>
<?php 
	$sqlEtiketCek = "SELECT * FROM Etiketler";
	$sonucEtiket = mysqli_query($baglan,$sqlEtiketCek);
?>

<!DOCTYPE HTML>
<html>
<head><meta name="viewport" content="width=device-width"/>
<title>Beyin Rehberi - Etiketlerim</title>
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
		
		$sqlUyeEtiketSil = "DELETE FROM `UyeEtiket` WHERE `UyeEtiket`.`uyeNo` = '$uyeNo'";
		$sonucUyeEtiketSil = mysqli_query($baglan, $sqlUyeEtiketSil);
		if (isset($_POST['etiketler'])) { $etiketler = $_POST['etiketler']; }
		if (!empty($etiketler)) {
					
			foreach($etiketler as $etiketNumarasi){
				$sqlUyeEtiketEkle = "INSERT INTO `UyeEtiket` (`etiketNo`, `uyeNo`) VALUES ('$etiketNumarasi', '$uyeNo')";
				$sonucUyeEtiketEkle = mysqli_query($baglan, $sqlUyeEtiketEkle);
			}
			if($sonucUyeEtiketEkle){
				echo "<div class='form'><h3>Etiketleriniz başarıyla güncellendi.</h3></div>";
			}
			
		}
		else if($sonucUyeEtiketSil){
			echo "<div class='form'><h3>Etiketleriniz başarıyla güncellendi.</h3></div>";
		}


					

					 
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
				<span><i class="icon-envelope-alt"></i>ETİKETLERİM</span>
				</h1>
				<div class="wrapcontact">
					<div class="done">
						<div class="alert-box success ctextarea">
							 Etiketleriniz güncellendi. Teşekkür ederiz! <a href="" class="close">x</a>
						</div>
					</div>
					<form action="etiketlerim.php" method="POST" enctype="multipart/form-data">
						<div class="form">
							
	
							
							<label> Etiketler </label>
							<?php 
								while($satirEtiket = mysqli_fetch_array($sonucEtiket)){ 
									$etiketNo = $satirEtiket['etiketNo'];
									$uyeEtiketSorgu = "SELECT * from UyeEtiket WHERE etiketNo='$etiketNo' AND uyeNo='$uyeNo'";
									$sonucUyeEtiket = mysqli_query($baglan, $uyeEtiketSorgu);
									
									
							?>
									<input type="checkbox" 
										name="etiketler[]" 
										value="<?php echo $etiketNo; ?>" 
										<?php if(mysqli_num_rows($sonucUyeEtiket)>0) echo 'checked'; ?> 
									> <?php echo $satirEtiket['etiketAdi']; ?><br>
							<?php
							}	
							?>
							
							
							
							<input type="submit" name="gonder" class="button" style="font-size:12px;" value="GÜNCELLE">
						</div>
					</form>
				</div>
			</div>
			<div class="c4 space-top">
				<h1 class="maintitle">
				<span><i class="icon-map-marker"></i> Locations</span>
				</h1>
				<p>
					<a class="link-2" href="more.html">The Company Name Inc.</a>
				</p>
				<dl>
					<dt>2536 Zamora Road, Missisipi, 74C</dt>
					<dd><span>Telephone:</span>+1 348 271 9483</dd>
					<dd><span>FAX:</span>+1 243 794 5734</dd>
					<dd>E-mail: <a href="more.html">mail@yourweb.com</a></dd>
				</dl>
				<br/>
				<dl>
					<dt>9863 - 9867 Mill Road, Cambridge, MG09 99HT</dt>
					<dt>Zamora Road, Missisipi, 74C</dt>
					<dd><span>Telephone:</span>+1 348 271 9483</dd>
					<dd><span>FAX:</span>+1 243 794 5734</dd>
					<dd>E-mail: <a href="more.html">mail@yourweb.com</a></dd>
				</dl>
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