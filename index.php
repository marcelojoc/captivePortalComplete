<!DOCTYPE html>
<?php
//Start session to grab MAC Address and have it available throughout the auth process
	session_start();
//Get MAC Address and assign it to _SESSION variable to be available throughout the auth process
ini_set('display_errors', '0');
	if($_GET['id']) {
		$id = $_GET['id'];
	} else {	
		$id="20:cf:30:84:00:68";
//		echo "<h1>Acceso directo no permitido</h1>";
//		exit();
	}
//Get original target URL for redirect after auth
	if ($_GET['url']) {
		$url = $_GET['url'];
	} else {
//If original URL not specified, default to ubnt.com
		$url = 'http://www.ubnt.com';
	}
	
	date_default_timezone_set('America/Buenos_Aires');

// $originalDate = "2010-03-21";
// $newDate = date("d-m-Y", strtotime($originalDate));
// echo $originalDate . "<br>";

// echo $newDate;

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" />
    <title>Diplomatic Hotel</title>

        <link rel="stylesheet" href="css/app.css">
        <link rel="stylesheet" href="css/my.css">
        <link rel="stylesheet" href="css/pikaday.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
</head>
<body>
    


<div class="container">   <!--inicio del contenedor principal--> 


    <div class="row">   <!--logo Principal-->

        <div class=" col-xs-12 col-lg-12  logo_movil ">

            <img id="logo-img" class=" img-responsive center-block" src="image/logo_d.png" />

        </div>
    </div>



<!--Slide imagenes-->

  <div class="row">

    <div class="  col-xs-12 col-lg-12  hidden-xs slide_relativo ">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

                  <div class="carousel-inner" role="listbox">
                      <div class="item active">
                      <img src="image/slide/slide-foto1.jpg" alt="..." class="">

                      </div>
                      <div class="item">
                      <img src="image/slide/slide-foto2.jpg" alt="..." class="">

                      </div>

                      <div class="item">
                      <img src="image/slide/slide-foto3.jpg" alt="..." class="">

                      </div>
                  </div>
              </div>

              


    <div class="  col-xs-12 col-lg-12 ">
          <div class="wifi_content center-block ">
          
            <i class="fa fa-wifi fa-3x center-block" aria-hidden="true"></i>
            <p>Acceso a Wifi / Wifi Access</p>
          </div>
      </div>
      </div>
  </div>


<!--  wifi access movil-->

  <div class="row">
    <div class="  col-xs-12 col-lg-12  visible-xs  ">
          <div class="wifi_content center-block ">    
            <i class="fa fa-wifi fa-3x center-block" aria-hidden="true"></i>
            <p>Acceso Wifi / Wifi Access</p>
          </div>
      </div>
  </div>


 <!--formulario login-->

<div class="row">

	<div class="  col-xs-12 col-md-6 col-md-offset-3 ">


<form class="form-horizontal" id="form_log" action="auth.php"  method="post" >
  <div class="form-group">
    <label for="txtmail" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control input-md" id="txtmail" name="txtmail"  placeholder="Email" required>
    </div>
  </div>
  <div class="form-group">
    <label for="txtnombre" class="col-sm-2 control-label">Nombre</label>
    <div class="col-sm-10">
      <input type="text" class="form-control input-md" id="txtnombre" name="txtnombre" placeholder="Nombre / Name / Nome" required>
    </div>
  </div>

<div class="form-group" id="divCheck">
  <label class="col-sm-2 control-label" for="check">Checkout</label>  
  <div class="col-sm-6">
  <input id="check" name="check" class="form-control input-md"  type="text" readonly="readonly">
  </div>
</div>


  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">

  <div class="radio-inline">
    <label for="radios-0" id="radio-0">
      <input name="radios" id="radio0" value="si"  type="radio">
      Huesped / Guest
    </label>
	</div>
  <div class="radio-inline">
    <label for="radios-1" id="radio-1">
      <input name="radios" id="radio1" value="no" type="radio" checked="checked">
      Visitante / Visitor
    </label>
	</div>
  </div>


    </div>

    <div role="alert" id="alerta">
    
    </div>



<input type=hidden name=mac value=<?php echo $id; ?> />
<input type=hidden name=url value=<?php echo $url; ?> />


  <div class="form-group">
    <div class="col-sm-8 col-sm-offset-2">
      <div class="checkbox">

        <label for="check1">
          <input type="checkbox"  id="check1"  name ="check1" onclick="enabledBtn()" > Acepto los terminos 
              
        </label>
          <i class="fa fa-chevron-down" aria-hidden="true" id="iconLegal"></i>

        <div class="col-xs-12  col-lg-12 deshabilitar " id='legal'>

              <p class="legal" >Los datos ingresados en esta plataforma serán utilizados por Diplomatic Hotel 
                para enviarle información sobre los productos y servicios exclusivos de la empresa, 
                durante su estadía y con posterioridad a la misma. Diplomatic Hotel garantiza la 
                seguridad y confidencialidad de los datos, ley 25.326.
              </p>

          
        </div>

      </div>
    </div>
  </div>


    <!-- legal ini -->



    <!-- legal fin -->


    <!-- Button -->
    <div class="form-group">
      <div class=" col-xs-12 col-md-8 col-md-offset-2 ">
        <button id="btn" name="btn"  class="btn btn-ttc btn-block" type="submit" disabled="disabled" >Login</button>
      </div>
    </div>

	
    </form>


  </div>

</div>



  <div class="row">
    <div class="  col-xs-12 col-lg-12">

    <hr>
      <footer>

        <center><p><small>www.diplomatichotel.com.ar</small></p></center>

      </footer> 
    </div>

  </div>


</div><!--Fin del contenedor principal-->


</body>


<script src="js/jquery-3.1.0.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/moment.js"></script>
<script src="js/pikaday.js"></script>
<script src="js/main.js"></script>

</html>
