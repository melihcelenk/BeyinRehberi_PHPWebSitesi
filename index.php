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
<title>Beyin Rehberi</title>
<?php require('styles.php'); ?>
</head>
<body>
<?php require('menu.php'); ?>
<?php
	$sqlGonderiCek = "SELECT * FROM Gonderiler WHERE gorunurluk='1' AND resim IS NOT NULL ORDER BY gonderiNo DESC";
	$sonucGonderiCek = mysqli_query($baglan,$sqlGonderiCek);
?>
<div class="undermenuarea">
	<div class="boxedshadow">
	</div>
	<!-- SLIDER AREA
	================================================== -->
	<div id="da-slider" class="da-slider">
		<!--Slide 1-->
		<div class="da-slide">
			<h2> Etiketlerinizi Seçin </h2>
			<p>
				Kişiselleştirilmiş anasayfanızda size özel seçilmiş gönderileri görün.
			</p>
			<a href="#" class="da-link" style="width:202px;">Size Özel Konular</a>
			<div class="da-img">
				<img src="/assets/images/bilgi-site1.jpg" alt="">
			</div>
		</div>
		<!--Slide 2-->
		<div class="da-slide">
			<h2> Hem öğrenin, hem öğretin</h2>
			<p>
				 Diğer kullanıcıların gönderilerini görün, siz de gönderilerinizi etiketleyerek insanların bilgilerine katkıda bulunun.
			</p>
			<a href="#" class="da-link" style="width:192px;">Bilgiyi Paylaşın</a>
			<div class="da-img">
				<img src="assets/images/bilgi-site2.jpg" alt="">
			</div>
		</div>
		
		<nav class="da-arrows">
		<span class="da-arrows-prev"></span>
		<span class="da-arrows-next"></span>
		</nav>
	</div>
</div>
<!-- UNDER SLIDER - BLACK AREA
================================================== -->
<div class="undersliderblack">
	<div class="grid">
		<div class="row space-bot">
			<div class="c12">
				<!--Box 1-->
				<div class="c4 introbox introboxfirst">
					<div class="introboxinner">
						<span class="homeicone">
						<i class="icon-bolt"></i>
						</span> Beynin rehberi bilgidir. Bilgiyi paylaşın.
					</div>
				</div>
				<!--Box 2-->
				<div class="c4 introbox introboxmiddle">
					<div class="introboxinner">
						<span class="homeicone">
						<i class="icon-cog"></i>
						</span> Kişiselleştirilmiş anasayfanızda dilediğiniz gönderileri görün.
					</div>
				</div>
				<!--Box 3-->
				<div class="c4 introbox introboxlast">
					<div class="introboxinner">
						<span class="homeicone">
						<i class="icon-lightbulb"></i>
						</span>
						Paylaşım yapabileceğiniz, farklı kişilerden yorum ve değerlendirmeler alabileceğiniz bu beyin rehberini sizler için oluşturduk.
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="shadowunderslider">
</div>


<<!-- START content area
================================================== -->
<div class="grid">
	<div class="row space-bot">
		<!--INTRO-->
		<div class="c12">
			<div class="royalcontent">
				<h1 class="royalheader">BEYİN REHBERİ'NE HOŞGELDİNİZ!</h1>
				<h1 class="title" style="text-transform:none;">Beyninize yeni şeyler öğrenmesi için fırsat verin!</h1>
			</div>
		</div>

	</div>
	<!-- SHOWCASE
	================================================== -->
	<?php if(isset($_SESSION['userid'])){
		
	?>
		<div class="row space-top">
			<div class="c12 space-top">
				<h1 class="maintitle ">
				<span>SİZE ÖZEL GÖNDERİLER</span>
				</h1>
			</div>
		</div>
		<?php if(mysqli_num_rows($sonucUyeEtiketCek)<1){
			echo "Hiç etiket seçmemişsiniz. Etiket eklemek için <a href='/etiketlerim.php'>tıklayın.<a/>";
		}
		?>
		<div class="row space-bot">
			<div class="c12">
				<div class="list_carousel">
					<div class="carousel_nav">
						<a class="prev" id="car_prev" href="#"><span>prev</span></a>
						<a class="next" id="car_next" href="#"><span>next</span></a>
					</div>
					<div class="clearfix">
					</div>
					<ul id="recent-projects">
						<!--1 gönderi liste elemanının başı -->
						<?php 
						$sonucUyeEtiketGonderiler = mysqli_query($baglan,$sqlUyeEtiketCek);
						while($satirUyeEtiketGonderiler = mysqli_fetch_array($sonucUyeEtiketGonderiler)){
							$etk = $satirUyeEtiketGonderiler['etiketNo'];
							$sqlGonderiEtiketCek = "SELECT * FROM GonderiEtiket WHERE etiketNo='$etk'";
							$sonucGonderiEtiketCek = mysqli_query($baglan,$sqlGonderiEtiketCek);
							
							while($satirGonderiEtiketCek = mysqli_fetch_array($sonucGonderiEtiketCek)){
								$gnd = $satirGonderiEtiketCek['gonderiNo'];
								$sqlEtiketliGonderiCek = "SELECT * FROM Gonderiler WHERE gorunurluk='1' AND resim IS NOT NULL AND gonderiNo ='$gnd' ";
								$sonucEtiketliGonderiCek = mysqli_query($baglan,$sqlEtiketliGonderiCek);
								$satirEtiketliGonderiCek = mysqli_fetch_array($sonucEtiketliGonderiCek);
								$satirEtiketliGonderiCek['baslik'];
						
						?>
						<li>
						<div class="featured-projects">
							<div class="featured-projects-image">
								<a href="/gonderidetay.php?id=<?php echo satirEtiketliGonderiCek['gonderiNo']; ?>"><img src="/images/gonderiler/<?php echo $satirEtiketliGonderiCek['resim']; ?>" class="imgOpa" alt=""></a>
							</div>
							<div class="featured-projects-content">
								<h1><a href="#"><?php echo $satirEtiketliGonderiCek['baslik']; ?></a></h1>
								<p>
									 <?php echo "<b>Gönderilme Tarihi: </b> ".$satirEtiketliGonderiCek['gonderilmeZamani'] ?>
								</p>
							</div>
						</div>
						</li>
						<?php 
							}
						}
						
						?>
						<!-- 1 gönderi liste elemanının sonu -->
					</ul>
					<div class="clearfix">
					</div>
				</div>
			</div>
		</div>
	<?php 
		}
		else { ?>
	
		<!-- SHOWCASE
	================================================== -->
	<div class="row space-top">
		<div class="c12 space-top">
			<h1 class="maintitle ">
			<span>EN YENİ GÖNDERİLER</span>
			</h1>
		</div>
	</div>
	<div class="row space-bot">
		<div class="c12">
			<div class="list_carousel">
				<div class="carousel_nav">
					<a class="prev" id="car_prev" href="#"><span>prev</span></a>
					<a class="next" id="car_next" href="#"><span>next</span></a>
				</div>
				<div class="clearfix">
				</div>
				<ul id="recent-projects">
					<!--1 gönderi liste elemanının başı -->
					<?php while($satirGonderiCek = mysqli_fetch_array($sonucGonderiCek)) { ?>
					<li>
					<div class="featured-projects">
						<div class="featured-projects-image">
							<a href="/gonderidetay.php?id=<?php echo satirGonderiCek['gonderiNo']; ?>"><img src="/images/gonderiler/<?php echo $satirGonderiCek['resim']; ?>" class="imgOpa" alt=""></a>
						</div>
						<div class="featured-projects-content">
							<h1><a href="#"><?php echo $satirGonderiCek['baslik']; ?></a></h1>
							<p>
								 <?php echo "<b>Gönderilme Tarihi: </b> ".$satirGonderiCek['gonderilmeZamani']; ?>
							</p>
						</div>
					</div>
					</li>
					<?php 
					}
					?>
					<!-- 1 gönderi liste elemanının sonu -->
				</ul>
				<div class="clearfix">
				</div>
			</div>
		</div>
	</div>
	<?php } ?>

	<!-- CALL TO ACTION 
	================================================== -->
	<div class="row space-bot">
			<!--Box 1-->
		<div class="c4">
			<h2 class="title hometitlebg"><i class="icon-qrcode smallrightmargin"></i> Responsive Theme</h2>
			<div class="noshadowbox">
				<h5>DELIVERY</h5>
				<p>
					 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam hendrerit lacus mattis orci fermentum mollis iaculis purus lobortis. In et purus ut nunc elementum dapibus facilisis in quam.
				</p>
				<p class="bottomlink">
					<a href="#" class="neutralbutton"><i class="icon-link"></i></a>
				</p>
			</div>
		</div>
		<!--Box 2-->
		<div class="c4">
			<h2 class="title hometitlebg"><i class="icon-cog smallrightmargin"></i> Unlimited Colors</h2>
			<div class="noshadowbox">
				<h5>QUALITY</h5>
				<p>
					 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam hendrerit lacus mattis orci fermentum mollis iaculis purus lobortis. In et purus ut nunc elementum dapibus facilisis in quam.
				</p>
				<p class="bottomlink">
					<a href="#" class="neutralbutton"><i class="icon-link"></i></a>
				</p>
			</div>
		</div>
		<!--Box 3-->
		<div class="c4">
			<h2 class="title hometitlebg"><i class="icon-user" style="margin-right:10px;"></i> MultiPurpose Use</h2>
			<div class="noshadowbox">
				<h5>PRICING</h5>
				<p>
					 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam hendrerit lacus mattis orci fermentum mollis iaculis purus lobortis. In et purus ut nunc elementum dapibus facilisis in quam.
				</p>
				<p class="bottomlink">
					<a href="#" class="neutralbutton"><i class="icon-link"></i></a>
				</p>
			</div>
		</div>
		<!-- --- --- -->
		<div class="c12">
			<div class="wrapaction">
				<div class="c9">
					<h1 class="subtitles">Salique is incredibly awesome, with a refreshingly clean design</h1>
					 We produce comprehensive mapping of consumers' relationships with communications across bought, owned & earned media based on bespoke insight. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam hendrerit lacus mattis orci fermentum mollis iaculis.
				</div>
				<div class="c3 text-center" style="margin-top:40px;">
					<div class="actionbutton">
						<i class=" icon-download-alt"></i> DOWNLOAD NOW
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!-- end grid -->

<?php require('footer.php'); ?>

<!-- END CONTENT AREA -->
<!-- JAVASCRIPTS
================================================== -->
<!-- all -->
<script src="/assets/js/modernizr-latest.js"></script>

<!-- menu & scroll to top -->
<script src="/assets/js/common.js"></script>

<!-- slider -->
<script src="/assets/js/jquery.cslider.js"></script>

<!-- cycle -->
<script src="/assets/js/jquery.cycle.js"></script>

<!-- carousel items -->
<script src="/assets/js/jquery.carouFredSel-6.0.3-packed.js"></script>

<!-- twitter -->
<script src="/assets/js/jquery.tweet.js"></script>

<!-- Call Showcase - change 4 from min:4 and max:4 to the number of items you want visible -->
<script type="text/javascript">
$(window).load(function(){			
			$('#recent-projects').carouFredSel({
				responsive: true,
				width: '100%',
				auto: true,
				circular	: true,
				infinite	: false,
				prev : {
					button		: "#car_prev",
					key			: "left",
						},
				next : {
					button		: "#car_next",
					key			: "right",
							},
				swipe: {
					onMouse: true,
					onTouch: true
					},
				scroll : 2000,
				items: {
					visible: {
						min: 4,
						max: 4
					}
				}
			});
		});	
</script>

<!-- Call opacity on hover images from carousel-->
<script type="text/javascript">
$(document).ready(function(){
    $("img.imgOpa").hover(function() {
      $(this).stop().animate({opacity: "0.6"}, 'slow');
    },
    function() {
      $(this).stop().animate({opacity: "1.0"}, 'slow');
    });
  });
</script>
</body>
</html>