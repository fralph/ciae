<?php
require_once (dirname ( dirname ( dirname ( __FILE__ ) ) ) . '/config.php');
require_once ('generos.php');
GLOBAL $USER, $CFG;
$teacherroleid = 3;
$logged = false;

if (isloggedin ()) {
	$logged = true;
	$courses = enrol_get_all_users_courses ( $USER->id );
	$countcourses = count ( $courses );
	foreach ( $courses as $course ) {
		$context = context_course::instance ( $course->id );
		$roles = get_user_roles ( $context, $USER->id, true );
		foreach ( $roles as $rol ) {
			if ($rol->roleid == $teacherroleid) {
				$asteachercourses [$course->id] = $course->fullname;
			}
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<!-- Head --> 
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>Lorem Ipsum</title>
<!-- CSS Font, Bootstrap, style de la página y auto-complete  --> 
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="auto-complete.css">

<!-- Fin CSS -->
<!-- Css traidos desde google, no sé cuales realmete se usan  --> 
<link
	href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,800,700,300'
	rel='stylesheet' type='text/css'>
<link
	href='http://fonts.googleapis.com/css?family=BenchNine:300,400,700'
	rel='stylesheet' type='text/css'>
<link rel="stylesheet"
	href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300">
<link rel="stylesheet"
	href="https://cdn.rawgit.com/yahoo/pure-release/v0.6.0/pure-min.css">
<!-- Fin CSS de google -->
<!-- Importar  Scripts Javascript -->
<script src="js/modernizr.js"></script>

<!-- Fin Script Javascript -->
<!-- Scripts JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script type="text/javascript" src="jquery-1.8.0.min.js"></script> 
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<!-- Script para filtro de genero -->
<script>
$(document).ready(function () {
    size_li = $("#genero li").size();
    x=3;
    $('#genero li:lt('+x+')').show();
    $('#loadMore').click(function () {
        x= size_li;
        $('#genero li:lt('+x+')').show();
        $('#genero').show().siblings('#loadMore').hide();
        $('#genero').show().siblings('#showLess').show();
    });
    $('#showLess').click(function () {
        x= 3;
        $('#genero li').not(':lt('+x+')').hide();
        $('#genero').show().siblings('#loadMore').show();
        $('#genero').show().siblings('#showLess').hide();
    });
});
</script>
<!-- Script del slider para filtro de Tiempo estimadoión -->
<script type="text/javascript">
$(function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 180,
      values: [1,90],
      slide: function( event, ui ) {
        $( "#amount" ).val(  ui.values[ 0 ] + " - " + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val(  $( "#slider-range" ).slider( "values", 0 ) +
      " - " + $( "#slider-range" ).slider( "values", 1 ) );
  });
</script>
<!-- Fin scripts JQuery -->
</head>
<!-- Fin de HEAD -->

<!-- BODY -->
<body>
<!-- Header  -->
<header class="top-header">	
	<div class="container">
		<div class="row">
			<div class="col-xs-3 header-logo">
				<a href="index.html"><img src="img/logo.png" alt=""	class="img-responsive logo"></a>
			</div>
			<div class="col-md-9">
				<nav class="navbar navbar-default">
					<div class="container-fluid nav-bar">
<!-- ============ Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed " data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								<span class="sr-only">Toggle navigation</span> 
								<span class="icon-bar"></span> 
								<span class="icon-bar"></span> 
								<span class="icon-bar"></span>
							</button>
						</div>
<!-- ========== Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav navbar-right">
								<li><a class="menu active" href="#home">Inicio</a></li>
								<li><a class="menu" href="#buscar">Buscar</a></li>
								<li><a class="menu" href="#nosotros">Sobre nosotros</a></li>
								<li><a class="menu" href="#profesor">Profesores</a></li>
								<li><a class="menu" href="#corrector">¿Quieres ser corrector? </a></li>
					      	    <?php 
					      	    //Si no ha iniciado sesión le mostrará un link al login de la plataforma 
					      	    if(!$logged){
					      	    echo '<li><a class="menu" href="'.$CFG->wwwroot.'/login/index.php">Entrar</a></li>';
					      	    }?>					        
					      	</ul>
						</div>
							<!-- /navbar-collapse -->
					</div>
					<!-- / .container-fluid -->
				</nav>
			</div>
		</div>
	</div>
</header>
<!-- fIN DEL header -->

<!-- BUSCADOR -->
<section class="buscar text-center">
	<div class="container">
		<div class="row">
			<h2></h2>
			<div class="col-md-1 col-sm-0">
			</div>
			</div>
	</div>
</section>
<section>
	<div class="container">
		<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-6">
			<form role="form">
  				<div class="form-group">
    				<label for="ejemplo_email_1">Título</label>
   					<input type="text" class="form-control" id="ejemplo_email_1" placeholder="Título de la actividad">
 				 </div>
 				 <div class="form-group">
    				<label for="ejemplo_email_1">Descripción</label>
   					<textarea class="form-control" rows="3"></textarea>
 				 </div>
 				 <div class="form-group">
    				<label for="ejemplo_email_1">Propósito comunicativo</label>
   					<input type="text" class="form-control" id="ejemplo_email_1" placeholder="Título de la actividad">
 				 </div>
 				 <div class="form-group">
    				<label for="ejemplo_email_1">Género</label>
   					<input type="text" class="form-control" id="ejemplo_email_1" placeholder="Título de la actividad">
 				 </div>
 				 <div class="form-group">
    				<label for="ejemplo_email_1">Audiencia</label>
   					<input type="text" class="form-control" id="ejemplo_email_1" placeholder="Título de la actividad">
 				 </div>
 				 <div class="form-group">
    				<label for="ejemplo_email_1">Tiempo estimado</label>
   					<input type="text" class="form-control" id="ejemplo_email_1" placeholder="Título de la actividad">
 				 </div>
 				 <div class="form-group">
    				<label for="ejemplo_email_1">Ejemplo</label>
   					<textarea class="form-control" rows="7"></textarea>
 				 </div>
 				 <div class="form-group">
    				<label for="ejemplo_email_1">Sugerencia</label>
   					<textarea class="form-control" rows="3"></textarea>
 				 </div>
 				 <div class="form-group">
    				<label for="ejemplo_email_1">Indicaciones</label>
   					<textarea class="form-control" rows="3"></textarea>
 				 </div>
 				 <div class="form-group">
    				<label for="ejemplo_email_1">Recursos de la lengua</label>
   					<textarea class="form-control" rows="3"></textarea>
 				 </div>
 				 <div class="form-group">
    				<label for="ejemplo_email_1">Instrucciones</label>
   					<textarea class="form-control" rows="3"></textarea>
 				 </div>
 				 <div class="form-group">
    				<label for="ejemplo_email_1">Video</label>
   					<input type="text" class="form-control" id="ejemplo_email_1" placeholder="Título de la actividad">
 				 </div>
  
  <button type="submit" class="btn btn-default">Enviar</button>
</form>
		</div>
		</div>
	</div>
</section>
</body>
<!-- footer starts here -->
<footer class="footer clearfix">
	<div class="container">
		<div class="row">
			<div class="col-xs-6 footer-para">
				<p>&copy; All right reserved</p>
			</div>
			<div class="col-xs-6 text-right">
				<a href=""><i class="fa fa-facebook"></i></a> <a href=""><i
					class="fa fa-twitter"></i></a>
			</div>
		</div>
	</div>
</footer>

	
<script src="js/bootstrap.min.js"></script>