<?php 
	if(!isset($_SESSION)){ 
		session_start();
	}
	if(isset($_SESSION['userid'])){
		$uyeNo = $_SESSION['userid'];
	}
	else { $uyeNo = -1; }
	$sqlUyeEtiketCek = "SELECT * FROM UyeEtiket WHERE uyeNo='$uyeNo'";
	$sonucUyeEtiketCek = mysqli_query($baglan,$sqlUyeEtiketCek);
	
?>

<!-- TOP LOGO & MENU
================================================== -->
<div class="grid">
	<div class="row space-bot">
		<!--Logo-->
		<div class="c4">
			<a href="index.php">
			<img src="/assets/images/logo.png" class="logo" alt="">
			</a>
		</div>
		<!--Menu-->
		<div class="c8">
			<nav id="topNav">
			<ul id="responsivemenu">
				<li class="active"><a href="/index.php"><i class="icon-home homeicon"></i><span class="showmobile">Home</span></a></li>

				<li class="last"><a href="/gonderiler.php">Gönderiler</a></li>
				
				<li class="last"><a href="/gonderiekle.php">Gönderi Ekle</a></li>
				<li class="last"><a href="/uyeler.php">Üyeler</a></li>
				<?php 
				if(!isset($_SESSION["username"])) {
					echo '<li class="last"><a href="/girisyap.php">Giriş Yap</a></li>';
				}
				else{
					echo ' 
					<li><a href="#">Etiketlerim</a>
						<ul style="display: none;">';
							while ($satirUyeEtiket=mysqli_fetch_array($sonucUyeEtiketCek)) { 
								$etiketNumarasi = $satirUyeEtiket['etiketNo'];
								$sqlOzelEtiketCek = "SELECT * FROM Etiketler WHERE etiketNo='$etiketNumarasi'";
								$sonucOzelEtiketCek = mysqli_query($baglan, $sqlOzelEtiketCek);
								$satirOzelEtiketCek = mysqli_fetch_array($sonucOzelEtiketCek);
							
							echo '<li><a href="#">'.$satirOzelEtiketCek['etiketAdi'].'</a></li>';
							}
							
					echo '
							<li class="last"><a href="/etiketlerim.php">+</a></li>
						</ul>
					</li>
					';
					echo '<li><a href="#">Oturum</a>';
					echo '<ul style="display: none;">';
					echo '<li class="last"><a href="/profil.php?id='.$uyeNo.'">Profil('.$_SESSION["username"].')</a></li>';
					echo '<li class="last"><a href="/cikisyap.php">Çıkış Yap</a></li>';
					echo '</ul>';
				}
				?>
				
			</ul>
			</nav>
		</div>
	</div>
</div>