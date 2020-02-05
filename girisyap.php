<?php require('baglan.php'); ?>
<!DOCTYPE HTML>
<html>
<head><meta name="viewport" content="width=device-width"/>
<title>Beyin Rehberi - Kayıt Ol</title>
<!-- STYLES & JQUERY 
================================================== -->
<link rel="stylesheet" type="text/css" href="/assets/css/style.css"/>
<link rel="stylesheet" type="text/css" href="/assets/css/icons.css"/>
<link rel="stylesheet" type="text/css" href="/assets/css/skinblue.css"/><!-- Change skin color here -->
<link rel="stylesheet" type="text/css" href="/assets/css/responsive.css"/>
<script src="/assets/js/jquery-1.9.0.min.js"></script><!-- scripts at the bottom of the document -->
</head>
<body>
<?php require('menu.php');
require('header.php');
?>
<?php
require('baglan.php');
if(!isset($_SESSION)) session_start();
// If form submitted, insert values into the database.
if (isset($_POST['username'])){
        // removes backslashes
	$username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
	$username = mysqli_real_escape_string($baglan,$username);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($baglan,$password);
	//Checking is user existing in the database or not
        $query = "SELECT * FROM `Uyeler` WHERE kullaniciAdi='$username'
and parola='".md5($password)."'";
	$result = mysqli_query($baglan,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
        if($rows==1){
		$satirUyeCek = mysqli_fetch_array($result);
	    $_SESSION['username'] = $username;
		$_SESSION['userid'] = $satirUyeCek['uyeNo'];
            // Redirect user to index.php
	    header("Location: index.php");
         }else{
	echo "<div class='form'>
<h3>Kullanıcı adı ya da parola yanlış</h3>
<br/>Tekrar denemek için <a href='girisyap.php'>tıklayın</a></div>";
	}
    }else{
?>
<!-- CONTENT
================================================== -->
<div class="grid">
		<div class="shadowundertop"></div>
		<div class="row space-bot">

		
		</div>
		<div class="row space-top">
			<!-- CONTACT FORM -->
			<div class="c8 space-top">
				<h1 class="maintitle">
				<span><i class="icon-envelope-alt"></i> Get in Touch</span>
				</h1>
				<div class="wrapcontact">
					<div class="done">
						<div class="alert-box success ctextarea">
							 Gönderme başarılı. <a href="" class="close">x</a>
						</div>
					</div>
					<div class="form">
					
						
						<h1>Giriş Yap</h1>
						<form action="" method="post" name="login">
						<input type="text" name="username" placeholder="Username" required />
						<input type="password" name="password" placeholder="Password" required />
						<input type="submit" name="submit" value="Giriş Yap" class="button" style="font-size:12px;"/>
						</form>
						<p>Üye değil misiniz? <a href='/kayitol.php'>Üye Olun</a></p>
						

					</div>
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

<?php } ?>
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

<!-- contact form -->
<script src="/assets/js/contact.js"></script>

</body>
</html>