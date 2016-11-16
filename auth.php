<?php
//error_reporting(E_ALL);
ini_set('display_errors', '1');

	require_once 'conf.php.inc';

	$email = trim($_POST['txtmail']);
	$mac = trim($_POST['mac']);
	$web = trim($_POST['url']);
	$name = trim($_POST['txtnombre']);
	$fecha = trim($_POST['check']);
	$huesped = trim($_POST['radios']);
	//$url= $newstr = str_replace(["http://", "www."], "", $web);
	
	


    $checkin = new \DateTime("@".time());
    $checkout = new \DateTime($fecha);
	
	
    $dias=$checkin->diff($checkout)->d;

		
	$auth = auth_user($name,$email,$mac,$fecha,$huesped,$table);
#	echo $url;
	if($auth) {
		//Minutes to authorize, change to suit your needs
		$minutes = 3600 + ($dias * 24 * 60);
#		echo $minutes;
		sendAuthorization($mac,$minutes);
	        echo '

			<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />

    <title>Diplomatic Hotel</title>
        <link rel="stylesheet" href="css/app.css">
        <link rel="stylesheet" href="css/my.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">

<script>
window.onload = function(){
  var theDelay = 10;
  var timer = setTimeout("showText()",theDelay*1000)
  var timer = setTimeout("hideText()",theDelay*1000)
}

function showText(){
  document.getElementById("delayedShowText").style.visibility = "visible";
  document.getElementById("delayedHideText").style.visibility = "hidden";
}

</script>

</head>
<body>
    
<div class="container">   <!--inicio del contenedor principal--> 
    <div class="row">   <!--logo Principal-->

        <div class=" col-xs-12 col-lg-12  logo_movil ">

            <img id="logo-img" class=" img-responsive center-block" src="image/logo_d.png" />

        </div>
        
    </div>
    <div class="row">   <!--texto Bienvenida-->

        <div class=" col-xs-12 col-lg-12 text-center" id="delayedHideText" style="visibility:visible">

            <h1>Por favor espere...</h1>

        </div>

        <div class=" col-xs-12 col-lg-12 text-center" id="delayedShowText" style="visibility:hidden">

            <h1>Gracias por elegir Diplomatic Hotel</h1>
 <br><h3>Su dispositivo se encuentra conectado a nuestra red WiFi.</h3>

        </div>
    </div>
<br><br>
  <div class="row" >
    <div class=" col-xs-12 col-lg-12">

    <hr>
      <footer >
          <div class="text-center center-block">
          <a href="https://www.facebook.com/HotelDiplomatic/"><i class="fa fa-facebook fa-1x social"></i></a>
          <a href="https://twitter.com/DiplomaticHotel"><i class="fa fa-twitter fa-x social"></i></a>
          <a href="https://www.linkedin.com/company/10409521?trk=tyah&trkInfo=clickedVertical%3Acompany%2CclickedEntityId%3A10409521%2Cidx%3A2-1-2%2CtarId%3A1469720865909%2Ctas%3Adiplomatic%20hotel"><i class="fa fa-linkedin fa-1x social"></i></a>
          <a href="https://www.tripadvisor.com.ar/Hotel_Review-g312781-d1390850-Reviews-Diplomatic_Hotel-Mendoza_Province_of_Mendoza_Cuyo.html"><i class="fa fa-tripadvisor fa-1x social"></i></a>
          
          <a href="https://www.instagram.com/diplomatichotel/"><i class="fa fa-instagram fa-1x social"></i></a>
          </div>
        <center><p><small><a href="http://www.diplomatichotel.com.ar/">www.diplomatichotel.com.ar</a></small></p></center>

      </footer> 
    </div>
  </div>
</div>



</body>

';


	}

?>

