<?php
require('baglan.php');
?>
<?php 
	$sqlEtiketCek = "SELECT * FROM Etiketler";
	$sonucEtiket = mysqli_query($baglan,$sqlEtiketCek);
?>

<!DOCTYPE HTML>
<html>
<head><meta name="viewport" content="width=device-width"/>
<title>Beyin Rehberi - Gönderiler</title>
<!-- STYLES & JQUERY 
================================================== -->
<link rel="stylesheet" type="text/css" href="/assets/css/style.css"/>
<link rel="stylesheet" type="text/css" href="/assets/css/icons.css"/>
<link rel="stylesheet" type="text/css" href="/assets/css/skinblue.css"/><!-- change skin color here -->
<link rel="stylesheet" type="text/css" href="/assets/css/responsive.css"/>
<script src="/assets/js/jquery-1.9.0.min.js"></script><!-- the rest of the scripts at the bottom of the document -->
</head>
<body>

<?php require('menu.php'); ?>

<?php require('header.php'); ?>

<?php
	$sqlGonderiCek = "SELECT * FROM Gonderiler WHERE gorunurluk='1' AND `resim` IS NOT NULL ORDER BY gonderiNo DESC";
	$sonucGonderiCek = mysqli_query($baglan,$sqlGonderiCek);
?>

<!-- CONTENT
================================================== -->
<div class="grid">
		<div class="shadowundertop">
		</div>
		<!-- begin categories -->
		<div class="row space-bot">
			<div class="c12">
				<h1 class="maintitle space-top">
				<span>TÜM GÖNDERİLER</span>
				</h1>
				<div id="nav">
					<ul class="option-set">
						<li><a href="" data-filter="*" class="selected">Hepsi</a></li>
						<?php
						while($satirEtiket = mysqli_fetch_array($sonucEtiket)){ ?>
						<li><a href="" data-filter=".cat<?php echo $satirEtiket['etiketNo']; ?>"><?php echo $satirEtiket['etiketAdi'];?></a></li>
						<?php 
						}
						?>
					
						
					</ul>
				</div>
			</div>
		</div>
		<!-- end categories -->
		<div class="row space-top">
			<div id="content">
			<?php
			
			while($satirGonderi = mysqli_fetch_array($sonucGonderiCek)){ 
			$catNo = $satirGonderi['gonderiNo'];
			$uyeNo = $satirGonderi['gonderenUyeNo'];
		    
			$sqlGonderiEtiketCek = "SELECT * FROM GonderiEtiket WHERE gonderiNo = '$catNo'";
			$sonucGonderiEtiket = mysqli_query($baglan,$sqlGonderiEtiketCek);
			
			$sqlUyeCek = "SELECT * FROM Uyeler WHERE uyeNo = '$uyeNo'";
			$sonucUye = mysqli_query($baglan,$sqlUyeCek);
			$satirUye = mysqli_fetch_array($sonucUye);
			?>
			<!-- box x -->
				<div class="boxfivecolumns<?php while($satirGonderiEtiket = mysqli_fetch_array($sonucGonderiEtiket)){ echo " cat".$satirGonderiEtiket['etiketNo']; } ?>">
					<div class="boxcontainer">
						<div class="mosaic-block cover mosaicover5col">
							<div class="mosaic-overlay">
								<img src="/images/gonderiler/<?php echo $satirGonderi['resim']; ?>" style='height: 100%; width: 100%; object-fit: contain' alt="">
							</div>
							<a href="/gonderidetay.php?id=<?php echo $satirGonderi['gonderiNo']; ?>" class="mosaic-backdrop blue">
							<div class="details">
								<b><?php echo $satirGonderi['gonderilmeZamani'];?></b>
								<p>
									 <?php echo $satirUye['kullaniciAdi'] ;?> tarafından
								</p>
								<i class="icon-link mosaiclink"></i>
							</div>
							</a>
						</div>
						<h1><a href="/gonderidetay.php?id=<?php echo $satirGonderi['gonderiNo']; ?>"><?php echo $satirGonderi['baslik']; ?></a></h1>
						<p>
							 <?php echo "<b>Gönderilme Tarihi:</b> ".$satirGonderi['gonderilmeZamani']; ?>
						</p>
					</div>
				</div>
			<?php
			}
			?>
			


				<!-- box 11 etc -->
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

<!-- filtering -->
<script src="/assets/js/jquery.isotope.min.js"></script>

<!-- hover effects -->
<script type="text/javascript" src="/assets/js/mosaic.1.0.1.min.js"></script>

<!-- CALL hover effects -->
<script type="text/javascript">  			
			$(document).ready(function($){				
				$('.cover').mosaic({
					animation	:	'slide',	//fade or slide
					hover_x		:	'578'		//Horizontal position on hover
				});		    
		    });		    
</script>

<!-- CALL isotope filtering -->
<script>
$(document).ready(function(){
var $container = $('#content');
  $container.imagesLoaded( function(){
        $container.isotope({
	filter: '*',
	animationOptions: {
     duration: 750,
     easing: 'linear',
     queue: false,
   }
});
});
$('#nav a').click(function(){
  var selector = $(this).attr('data-filter');
    $container.isotope({ 
	filter: selector,
	animationOptions: {
     duration: 750,
     easing: 'linear',
     queue: false,
   }
  });
  return false;
});
$('#nav a').click(function (event) {
    $('a.selected').removeClass('selected');
    var $this = $(this);
    $this.addClass('selected');
    var selector = $this.attr('data-filter');
    $container.isotope({
         filter: selector
    });
    return false; // event.preventDefault()
});
});
 </script>
</body>
</html>