<?php
require('baglan.php');
?>

<!DOCTYPE HTML>
<html>
<head><meta name="viewport" content="width=device-width"/>
<title>Salique Theme Multipurpose Responsive </title>
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
<?php

	$sqlUyeCek = "SELECT * FROM Uyeler";
    $sonucUye = mysqli_query($baglan,$sqlUyeCek);
	
	$sqlRolCek = "SELECT * FROM Roller";
	$sonucRol = mysqli_query($baglan,$sqlRolCek);

?>
	
	

<?php require('header.php'); ?>
<!-- CONTENT
================================================== -->
<div class="grid">
		<div class="shadowundertop">
		</div>
	<!-- begin categories -->
	<div class="row space-bot">

		<div class="c12">
			<h1 class="maintitle space-top">
				<span>ÜYELER</span>
			</h1>
			<div id="nav">
				<ul>
					<li><a href="" data-filter="*" class="selected">Hepsi</a></li>
					<?php
						while($satirRol = mysqli_fetch_array($sonucRol)){ ?>
						<li><a href="" data-filter=".cat<?php echo $satirRol['rolNo']; ?>"><?php echo $satirRol['rolAdi'];?></a></li>
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
		
			
			
			while($satirUye = mysqli_fetch_array($sonucUye)){ 
				$cekilecekUyeNo = $satirUye['uyeNo'];
				$uyeRolCek = "SELECT * FROM UyeRol WHERE uyeNo='$cekilecekUyeNo'";
				$sonucUyeRol = mysqli_query($baglan,$uyeRolCek); 
			
			?>
			
			
			<div class="boxfourcolumns <?php while($satirUyeRol = mysqli_fetch_array($sonucUyeRol)){ echo " cat".$satirUyeRol['rolNo']; } ?>">
				<div class="boxcontainer">
					<a href="#"><img src="/assets/images/userlogo.png" alt=""></a>
					<h1><a href="#"><?php echo $satirUye['kullaniciAdi'];  ?></a></h1>
					<p>
						 Kayıt Tarihi:<?php echo  $satirUye['kayitTarihi'] ?>
					</p>
				</div>
			</div>
			<?php 
			}
			?>

			
			
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

<!-- CALL filtering & masonry-->
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
 
 <!-- Call opacity on hover images-->
<script type="text/javascript">
$(document).ready(function(){
    $(".boxcontainer img").hover(function() {
      $(this).stop().animate({opacity: "0.6"}, 'slow');
    },
    function() {
      $(this).stop().animate({opacity: "1.0"}, 'slow');
    });
  });
</script>
</body>
</html>