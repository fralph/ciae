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
			<div class="col-md-11">
				<form method="get" action="resultados.php" class="pure-form">
					<div class="form-group">
						<div class="col-md-7">
							<input class="recursos"  type="text" name="name" placeholder="Nombre">
						</div>
						<div class="col-md-3">
							<button type="submit" class="btn btn-default btn-lg">Buscar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<!-- FIN BUSCADOR -->

<!-- Barra de información sobre el resultado, incluye un ordenador del mismo -->
<section class="barraResultado">
<hr>
	<div class="container">
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-8">
				<p>3 Resultado(s) </p>
			</div>
			<div class="col-md-2">
				<select class="form-control">
					<option>Ordenar por:</option>
 					<option>Comentarios</option>
  					<option>Likes</option>
  					<option>Vistos</option>
				</select>
			</div>
		</div>
	</div>
</section>
<!-- FIN BARRA DE INFORMACIÓN DE RESULTADO -->	

<!-- RESULTADOS -->
<section class="resultados">
	<div class="container">
		<div id="filtros" class="col-md-3" style="text-align: left">
			<div class="panel panel-default">
				<div class="panel-body">	
					<h1 style="text-align: left">Filtros</h1>
					<h3 style="text-align: left">Tipo de recurso</h3>
					<ul>
						<li>
						<div class="checkbox">
						<input type="checkbox" name="rubrica" value="1"> Actividad
						</div>
						</li>
						<li>
						<div class="checkbox">
						<input type="checkbox" name="rubrica" value="1"> Rúbrica
						</div>
						</li>
					</ul>
					<h3 style="text-align: left">Géneros</h3>
					<ul id="genero">
						<?php
						// recorre el arreglo que contiene todos los generos, por cada uno crea un checkbox y una lista
						for($i=0;$i<count($generos);$i++){
							echo'<li>
							<div class="checkbox">
							<input type="checkbox" name="'.$generos[$i].'"> '.$generos[$i].'
							</div>
							</li>';
						}
						?>
					</ul>
					<div id="loadMore">Ver más...</div>
					<div id="showLess">Ver menos...</div>	
					<h3 style="text-align: left"></h3>
					
					<h3 style="text-align: left">Calificación</h3>
					<ul id="calificacion">
						<li>
						<div class="checkbox">
							<input type="checkbox" name="unaEstrella" value="1">
							<span class="glyphicon glyphicon-star" aria-hidden="true" ></span>
							<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
							<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
							<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
							<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
						</div>
						</li>
						<li>
						<div class="checkbox">
							<input type="checkbox" name="dosEstrella" value="1">
							<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
							<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
							<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
							<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
							<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
						</div>
						</li>
						<li>
						<div class="checkbox">
							<input type="checkbox" name="tresEstrella" value="1">
							<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
							<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
							<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
							<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
							<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
						</div>
						</li>
						<li>
						<div class="checkbox">
							<input type="checkbox" name="cuatroEstrella" value="1">
							<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
							<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
							<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
							<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
							<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
						</div>
						</li>
						<li>
						<div class="checkbox">
							<input type="checkbox" name="cincoEstrella" value="1">
							<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
							<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
							<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
							<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
							<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
						</div>
						</li>
					</ul>					
				</div>
			</div>
		</div>
		<div id="resultados" class="col-md-9" style="text-align: left">
			
			<div class="panel panel-default">
			<div class="single-result-detail clearfix">
			<div data-toggle="modal" data-target="#myModal">
			
				<div id="descripcion" class="panel-body">
			<center><h3>Amigos por correspondencia</h3></center>
					<div  class="col-md-4" style="text-align: left">
						<p>Propósito Comunicativo: Informar</p>
						<p>Género: Carta de presentación personal</p>
						<p>Audiencia: Amigo</p>
						<p>Tiempo estimado: 90 min.</p>
						<p>Contiene: 
							<span class="glyphicon glyphicon-film" aria-hidden="false"></span>
							<span class="glyphicon glyphicon-book" aria-hidden="false"></span>
							<span class="glyphicon glyphicon-print" aria-hidden="false"></span>
						</p>
					</div>
					<div  class="col-md-5">
						<p>El producto final es una carta
							de dos párrafos de extensión destinada a un amigo de un
							curso paralelo, de un colegio cercano o de séptimo año,
							según resulte más adecuado a la realidad del colegio El
							producto final es una carta de dos párrafos de extensión
							destinada a un amigo de un curso paralelo, de un colegio
							cercano o de séptimo año, según resulte más adecuado a la
							realidad del colegio</p>
					</div>
					<div  class="col-md-3" style="text-align: left">
					<img src="img/premio.png" class="premio" height="40px" width="40px">
					<p>55 Visitas</p>
					<p>3 Comentarios</p>
					<p>20 votos</p>
					<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
					<p></p><p></p>
					<p style="font-size: 14px;">Creado por:<a href="perfil.html"> Natalia Ávila</a></p>
					
					</div>
				</div>
			</div>	
			</div>
			</div>
			
			<div class="panel panel-default">
			<div class="single-result-detail clearfix">
			<div data-toggle="modal" data-target="#myModal">
			
				<div id="descripcion" class="panel-body">
			<center><h3>Amigos por correspondencia</h3></center>
					<div  class="col-md-4" style="text-align: left">
						<p>Propósito Comunicativo: Informar</p>
						<p>Género: Carta de presentación personal</p>
						<p>Audiencia: Amigo</p>
						<p>Tiempo estimado: 90 min.</p>
						<p>Contiene: 
							<span class="glyphicon glyphicon-film" aria-hidden="false"></span>
							<span class="glyphicon glyphicon-book" aria-hidden="false"></span>
							<span class="glyphicon glyphicon-print" aria-hidden="false"></span>
						</p>
					</div>
					<div  class="col-md-5">
						<p>El producto final es una carta
							de dos párrafos de extensión destinada a un amigo de un
							curso paralelo, de un colegio cercano o de séptimo año,
							según resulte más adecuado a la realidad del colegio El
							producto final es una carta de dos párrafos de extensión
							destinada a un amigo de un curso paralelo, de un colegio
							cercano o de séptimo año, según resulte más adecuado a la
							realidad del colegio</p>
					</div>
					<div  class="col-md-3" style="text-align: left">
					<img src="img/premio.png" class="premio" height="40px" width="40px">
					<p>55 Visitas</p>
					<p>3 Comentarios</p>
					<p>20 votos</p>
					<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
					<p></p><p></p>
					<p style="font-size: 14px;">Creado por:<a href="http://www.gogle.cl"> Natalia Ávila</a></p>
					
					</div>
				</div>
			</div>	
			</div>
			</div>
			
			<div class="panel panel-default">
			<div class="single-result-detail clearfix">
			<div data-toggle="modal" data-target="#myModal">
			
				<div id="descripcion" class="panel-body">
			<center><h3>Amigos por correspondencia</h3></center>
					<div  class="col-md-4" style="text-align: left">
						<p>Propósito Comunicativo: Informar</p>
						<p>Género: Carta de presentación personal</p>
						<p>Audiencia: Amigo</p>
						<p>Tiempo estimado: 90 min.</p>
						<p>Contiene: 
							<span class="glyphicon glyphicon-film" aria-hidden="false"></span>
							<span class="glyphicon glyphicon-book" aria-hidden="false"></span>
							<span class="glyphicon glyphicon-print" aria-hidden="false"></span>
						</p>
					</div>
					<div  class="col-md-5">
						<p>El producto final es una carta
							de dos párrafos de extensión destinada a un amigo de un
							curso paralelo, de un colegio cercano o de séptimo año,
							según resulte más adecuado a la realidad del colegio El
							producto final es una carta de dos párrafos de extensión
							destinada a un amigo de un curso paralelo, de un colegio
							cercano o de séptimo año, según resulte más adecuado a la
							realidad del colegio</p>
					</div>
					<div  class="col-md-3" style="text-align: left">
					<img src="img/premio.png" class="premio" height="40px" width="40px">
					<p>55 Visitas</p>
					<p>3 Comentarios</p>
					<p>20 votos</p>
					<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
					<p></p><p></p>
					<p style="font-size: 14px;">Creado por:<a href="http://www.gogle.cl"> Natalia Ávila</a></p>
					
					</div>
				</div>
			</div>	
			</div>
			</div>
			
		</div>
	</div>
</section>
<!-- FIN RESULTADOS -->	
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
<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Modal Header</h4>
				</div>
				<div class="modal-body">
					<h2>Amigos por correspondencia</h2>
  		<?php if(!$logged){?>
  		<div class="alert alert-danger" role="alert">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<a href="http://localhost:8080/moodle/login/index.php">Debes iniciar sesión</a> para descargar el contenido.
			<a href="http://localhost:8080/moodle/login/signup.php">Regístrate gratis.</a>
		</div>
		<?php }?>
		<?php if($logged){?>
		<div class="container">
			<div class="col-md-4 text-left descargas">
				<br>
				<span class="glyphicon glyphicon-download-alt"	aria-hidden="true" style="font-size: 20px;"></span>
				<a href="documentos/tarea.mayas.pdf" target="_blank">Descargar	Tarea</a></br>
				<span class="glyphicon glyphicon-download-alt" aria-hidden="true" style="font-size: 20px;"></span>
				<a href="documentos/pauta.pdf" target="_blank">Descargar Rúbrica Sugerida</a></br>
				
			</div>
				<div class="col-md-5  col-md-offset-0 text-left">
					<div class="panel panel-default">
						<div class="panel-body">
							<form role="form" action="<?php echo $CFG->wwwroot.'/course/modedit.php';?>">
								<div class="checkbox">
									<label class="checkbox-inline"> <input type="checkbox" name="rubrica" value="1">
									 	Agregar Rúbrica Sugerida
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" name="marcadores" value="1"> Agregar	Marcadores Sugeridos
									</label>
								</div>
								<select class="form-control" name="course">
									<option>Seleccione el curso</option>
 									 <?php
										foreach ( $asteachercourses as $key => $asteachercourse ) {
										echo '<option value="' . $key . '"> ' . $asteachercourse . ' </option>';
										}?>
  								</select>
  								<input type="hidden" value="emarking" name="add">
								<input type="hidden" value="" name="type">
								<input type="hidden" value="1" name="section">
								<input type="hidden" value="0" name="return">
								<input type="hidden" value="0" name="sr">
								<br>
			<?php
			if ($countcourses > 0) {
				?>
  				<button type="submit" class="btn btn-info" style="font-size: 18px;">Agregar	Recurso</button>
  			<?php }else { ?>
  				<button type="submit" class="btn btn-info" disabled="disabled">Utilizar	Tarea</button>
 			<?php }?>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php }?>
			<h3>Ejemplos</h3>
			<p style="text-align: right;font-size: 18px;">Quito, 3 de noviembre de 2016</p>
			<p style="text-align: left;font-size: 18px;">Estimada amiga:</p>
			<p style="text-align: justify;font-size: 18px;">Hola, Nati. Espero que te encuentres
			bien al recibir esta primera carta. Estoy muy contento de que
			seamos amigos por correspondencia, es algo muy especial ya que las
			cartas casi no se usan ahora. Te cuento que vivo en Ecuador y me
			encanta jugar béisbol. Pero además, me gusta mucho el animé y
			sueño con tener mi propio “fan fiction” con una historia paralela
			de Naruto. ¿Conoces la animación japonesa? ¿Has visto Naruto
			alguna vez?</p>
			<p style="text-align: justify; font-size: 18px;">Soy un niño normal, tengo pocos amigos
			pero muy cercanos. En el colegio me va más o menos, pero mis
			clases favoritas son dibujo y lenguaje. Espero tu carta para saber
			cómo eres tú. También te mando una foto de Quito, la ciudad en que
			vivo.</p>
			<p style="text-align: left; font-size: 18px;">Muchos cariños y hasta pronto,</p>
			<p style="text-align: left font-size: 18px;">Juan Anabalón</p>
			<h3>Videos</h3>
			<center>
				<iframe width="560" height="315" src="https://www.youtube.com/embed/_LfywvezuVQ" frameborder="0" allowfullscreen></iframe>
			</center>
			<div id="comentarios">
				<h3>Comentarios</h3>
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="container">
								<div class="col-md-2 text-left descargas">
									<img src="img/myAvatar.png" alt="Smiley face" height="100"	width="100">
									<h3>Paulina Rosas</h3>
									<h4>Miembro nivel 5</h4>
								</div>
								<div class="col-md-6 text-left descargas">
									<h3 style="margin-top: 0px; margin-bottom: 0px;"> Excelente actividad 
										<span class="glyphicon glyphicon-star" aria-hidden="true" style="font-size: 20px;"></span>
										<span class="glyphicon glyphicon-star" aria-hidden="true" style="font-size: 20px;"></span>
										<span class="glyphicon glyphicon-star" aria-hidden="true" style="font-size: 20px;"></span>
										<span class="glyphicon glyphicon-star" aria-hidden="true" style="font-size: 20px;"></span>
										<span class="glyphicon glyphicon-star-empty" aria-hidden="true"	style="font-size: 20px;"></span>
									</h3>
									<p style="font-size: 18px;">Lorem ipsum dolor sit amet,
										consectetur adipiscing elit. Etiam eget commodo eros.
										Pellentesque aliquam diam et odio accumsan consectetur.
										Integer justo sapien, pharetra eu consectetur vitae,
										tincidunt vitae dolor. In porta condimentum dui, et pharetra
										sem pulvinar volutpat. In hac habitasse platea dictumst.
										Curabitur tincidunt nec eros non semper. Nulla velit erat,
										malesuada a iaculis sed, pharetra id ligula. Class aptent
										taciti sociosqu ad litora torquent per conubia nostra, per
										inceptos himenaeos..</p>
								</div>
							</div>
						</div>
					</div>
				</div>
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="container">
								<div class="col-md-2 text-left descargas">
									<img src="img/avatar.jpg" alt="Smiley face" height="100"
										width="100">
									<h3>Sergio Pizarro</h3>
									<h4>Miembro nivel 2</h4>
								</div>
								<div class="col-md-6 text-left descargas">
									<h3 style="margin-top: 0px; margin-bottom: 0px;">Muy buena 
										<span class="glyphicon glyphicon-star" aria-hidden="true" style="font-size: 20px;"></span>
										<span class="glyphicon glyphicon-star" aria-hidden="true" style="font-size: 20px;"></span>
										<span class="glyphicon glyphicon-star" aria-hidden="true" style="font-size: 20px;"></span>
										<span class="glyphicon glyphicon-star-empty" aria-hidden="true" style="font-size: 20px;"></span>
										<span class="glyphicon glyphicon-star-empty" aria-hidden="true" style="font-size: 20px;"></span>
									</h3>
									<p style="font-size: 18px;">Lorem ipsum dolor sit amet,
										consectetur adipiscing elit. Etiam eget commodo eros.
										Pellentesque aliquam diam et odio accumsan consectetur.
										Integer justo sapien, pharetra eu consectetur vitae, tincidunt
										vitae dolor. In porta condimentum dui, et pharetra sem
										pulvinar volutpat. In hac habitasse platea dictumst. Curabitur
										tincidunt nec eros non semper. Nulla velit erat, malesuada a
										iaculis sed, pharetra id ligula. Class aptent taciti sociosqu
										ad litora torquent per conubia nostra, per inceptos
										himenaeos..</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
<script src="js/bootstrap.min.js"></script>