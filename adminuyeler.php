<?php
require('baglan.php');
$sqlUyeCek = "SELECT * FROM Uyeler";
$sonucUye = mysqli_query($baglan,$sqlUyeCek);


if (isset($_REQUEST['sil'])){
        // removes backslashes
		$silinecekUyeNo = stripslashes($_REQUEST['uyeNumarasi']);
		// $email = mysqli_real_escape_string($baglan,$email);
        $silSorgusu = "DELETE from `Uyeler` WHERE uyeNo = '$silinecekUyeNo'";
        $sonucSil = mysqli_query($baglan,$silSorgusu);
        if($sonucSil){
            echo "Silindi";
			echo("<script>location.href ='admin.php';</script>");
        }
		else {
			echo "Silme işlemi başarısız.";
		}
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
                     <h2>BLANK PAGE </h2>   
                    </div>
                </div>       
                                   <div class="col-lg-12 col-md-12">
                        <h5>Table  Sample One</h5>
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    
                                    <th>No</th>
                                    <th>Kullanıcı Adı</th>
									<th>E-Posta</th>
									<th>Ad</th>
									<th>Soyad</th>
									<th>Meslek</th>
									<th>Kayıt Tarihi</th>
									<th>Sil</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php 
							while($satir = mysqli_fetch_array($sonucUye)){
							?>
                                <tr>
                                    <?php 
																	 echo "<td>".$satir['uyeNo']."</td>"; 
                                                                     echo "<td>".$satir['kullaniciAdi']."</td>";
																	 echo "<td>".$satir['eposta']."</td>";
																	 echo "<td>".$satir['ad']."</td>";
																	 echo "<td>".$satir['soyad']."</td>";
																	 echo "<td>".$satir['meslek']."</td>";
																	 echo "<td>".$satir['kayitTarihi']."</td>";
																	 echo '<td><form name="uyeSil" action="" method="post">';
																	 echo "<input name='uyeNumarasi' type='hidden' value='".$satir['uyeNo']."'>";
																	 echo '<input type="submit" name="sil" value="Sil" class="btn btn-danger"/></form></td>';
																	
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
