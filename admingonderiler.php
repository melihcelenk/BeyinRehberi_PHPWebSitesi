<?php
require('baglan.php');
$sqlGonderiCek = "SELECT * FROM Gonderiler";
$sonucGonderi = mysqli_query($baglan,$sqlGonderiCek);


if (isset($_REQUEST['sil'])){
        // removes backslashes
		$silinecekGonderiNo = stripslashes($_REQUEST['gonderiNumarasi']);
		// $email = mysqli_real_escape_string($baglan,$email);
        $silSorgusu = "DELETE from `Gonderiler` WHERE gonderiNo = '$silinecekGonderiNo'";
        $sonucSil = mysqli_query($baglan,$silSorgusu);
        if($sonucSil){
            echo "Silindi";
			echo("<script>location.href ='admin2.php';</script>");
        }
		else {
			echo "Silme işlemi başarısız.";
		}
}
if(isset($_POST['onayla'])){
			$gonderiID = $_POST['gonderiNumarasi'];
			$sqlGonderiOnayla = "UPDATE `Gonderiler` SET `gorunurluk` = '1' WHERE `Gonderiler`.`gonderiNo` = '$gonderiID'";
			mysqli_query($baglan,$sqlGonderiOnayla);
			echo("<script>location.href ='admin2.php';</script>");
		}	
		if(isset($_POST['onayKaldir'])){
			$gonderiID = $_POST['gonderiNumarasi'];
			$sqlGonderiOnayKaldir = "UPDATE `Gonderiler` SET `gorunurluk` = '0' WHERE `Gonderiler`.`gonderiNo` = '$gonderiID'";
			mysqli_query($baglan,$sqlGonderiOnayKaldir);
			echo("<script>location.href ='admin2.php';</script>");
		}	


?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Simple Responsive Admin</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="/assets/admin/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="/assets/admin/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="/assets/admin/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    
           
          
<?php require('adminnav.php'); ?>

        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Gönderiler </h2>   
                    </div>
                </div>       
                                   <div class="col-lg-12 col-md-12">
                        <h5>Table  Sample One</h5>
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    
                                    <th>No</th>
                                    <th>Başlık</th>
									<th>İçerik</th>
									<th>G.Üye No</th>
									<th>Gönderilme Zamanı</th>
									<th>Görünürlük</th>
									<th>Resim</th>
									<th>Sil</th>
									<th>Görünürlük Onayı</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php 
							while($satir = mysqli_fetch_array($sonucGonderi)){
							?>
                                <tr>
                                    <?php 
																	 echo "<td>".$satir['gonderiNo']."</td>"; 
                                                                     echo "<td>".$satir['baslik']."</td>";
																	 if(strlen($satir['icerik'])>35){
																	 echo "<td>".substr($satir['icerik'],0,30)."</td>";
																	 }
																	 else echo "<td>".$satir['icerik']."</td>";
																	 echo "<td>".$satir['gonderenUyeNo']."</td>";
																	 echo "<td>".$satir['gonderilmeZamani']."</td>";
																	 echo "<td>".$satir['gorunurluk']."</td>";
																	 echo "<td>".$satir['resim']."</td>";
																	 echo '<td><form name="gonderiSil" action="" method="post">';
																	 echo "<input name='gonderiNumarasi' type='hidden' value='".$satir['gonderiNo']."'>";
																	 echo '<input type="submit" name="sil" value="Sil" class="btn btn-danger"/></form></td>';
									                                 echo '<td><form name="gorunurluk" action="" method="post">';
																	 echo "<input name='gonderiNumarasi' type='hidden' value='".$satir['gonderiNo']."'>";
										                           if ($satir['gorunurluk']==0) 
															         echo "<input type='submit' name='onayla' class='btn btn-success' value='Onayla'>";
										                        else echo "<input type='submit' name='onayKaldir' class='btn btn-warning' value='Onayı Kaldır'></td>";
										                             echo "</form>";
										                         
									?>
																	 
								
                                </tr>
							<?php
							}
							?>
                          
                            </tbody>
                        </table>

                    </div>
                 <!-- /. ROW  -->
                  <hr />
              
                 <!-- /. ROW  -->           
			</div>
             <!-- /. PAGE INNER  -->
        </div>
         <!-- /. PAGE WRAPPER  -->
    </div>
    <div class="footer">
      
    
             <div class="row">
                <div class="col-lg-12" >
                    &copy;  2014 yourdomain.com | Design by: <a href="http://binarytheme.com" style="color:#fff;"  target="_blank">www.binarytheme.com</a>
                </div>
        </div>
        </div>
          

     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="/assets/admin/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="/assets/admin/js/bootstrap.min.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="/assets/admin/js/custom.js"></script>
    
   
</body>
</html>
