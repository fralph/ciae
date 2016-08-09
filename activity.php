<?php
require_once (dirname ( dirname ( dirname ( __FILE__ ) ) ) . '/config.php');
require_once ('generos.php');
GLOBAL $USER, $CFG;
$teacherroleid = 3;
$logged = false;
// Id of the exam to be deleted.
$activityid = required_param('id', PARAM_INT);


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
$activity=$DB->get_record('emarking_activities',array('id'=>$activityid));
$user_object = $DB->get_record('user', array('id'=>$activity->userid));

$rubric=$DB->get_records_sql("SELECT grl.id,
									 grc.id as grcid,
									 grl.score,
									 grl.definition, 
									 grc.description, 
									 grc.sortorder, 
									 gd.name
							  FROM {gradingform_rubric_levels} as grl,
	 							   {gradingform_rubric_criteria} as grc,
    							   {grading_definitions} as gd
							  WHERE gd.id=? AND grc.definitionid=gd.id AND grc.id=grl.criterionid
							  ORDER BY grcid, grl.id",
							  array($activity->rubric_id));

foreach ($rubric as $data) {
	
	$table[$data->description][$data->definition]=$data->score;
}
$col=0;
foreach ($table as $calc) {
	
	$actualcol=sizeof($calc);
	if($col < $actualcol){
		$col=$actualcol;
	}
	
}
$row=sizeof($table);


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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!-- Script para filtro de genero -->

</head>

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
								<li><a class="menu" href="buscar.php">Buscar</a></li>
								<li><a class="menu" href="#nosotros">Sobre nosotros</a></li>
								<li><a class="menu" href="#profesor">Profesores</a></li>
								<li><a class="menu" href="#corrector">¿Quieres ser corrector? </a></li>
					      				        
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
<section class="perfil">
	<div class="container">
		<div class="row">
			<h2></h2>
			<div class="col-md-3">
			<div class="panel panel-default">
					<div class="panel-body">
					<h3>Usar actividad</h3>
					<form role="form" action="<?php echo $CFG->wwwroot.'/course/modedit.php';?>">
								
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
  				<button type="submit" class="btn btn-info" style="font-size: 18px;">Utilizar Actividad</button>
  			<?php }else { ?>
  				<button type="submit" class="btn btn-info" disabled="disabled">Utilizar	Actividad</button>
 			<?php }?>
						</form>
					</div>
			</div>
				<div class="panel panel-default">
					<div class="panel-body">
					<h3>Resumen</h3>
					
					<p>Título: <?php echo $activity->title; ?></p>
					<p>Descipción: <?php echo $activity->description;?></p>
					<p>OA: <?php echo $activity->oa; ?></p>
					<p>Propósito comunicativo: <?php echo $activity->comunicative_pupose; ?></p>
					<p>Género: <?php echo $activity->genre; ?></p>
					<p>Audiencia: <?php echo $activity->audience; ?></p>
					<p>Tiempo estimado: <?php echo $activity->estimated_time; ?> minutos</p>
					<p>Creado por: <?php echo $user_object->firstname.' '.$user_object->lastname ?> </p>


					

					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-body" >
					<h2 class="title"> <?php echo $activity->title ?> </h2>
					
 
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Instrucciones</a></li>
    <li><a data-toggle="tab" href="#menu1">Didáctica</a></li>
    <li><a data-toggle="tab" href="#menu2">Rúbrica</a></li>
  </ul>

  <div class="tab-content">
	<div id="home" class="tab-pane fade in active">
		<h3 style="text-align: left;">Instrucciones</h3>
			
		<div class="panel panel-default">
			<div class="panel-body">	
				<?php 
				echo $activity->instructions;
				?>
			</div>
		</div>
	</div>


	<div id="menu1" class="tab-pane fade">
		<h3 style="text-align: left;">Didáctica</h3>
		<div class="panel panel-default">
			<div class="panel-body">
				<h4 style="text-align: left;">Didáctica</h4>	
				<?php 
				echo $activity->didactic_suggestions;
				?>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<h4 style="text-align: left;">Sugerencias</h4>	
				<?php 
				echo $activity->didactic_instructions;
				?>

			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<h4 style="text-align: left;">Recursos de la lengua</h4>	
				<?php 
				echo $activity->language_resources;
				?>

			</div>
		</div>

				
	</div>

	 <div id="menu2" class="tab-pane fade">
	 <h3 style="text-align: left;">Rúbrica</h3>
			<table class="table table-bordered">
 					<thead>
     					<tr>
     				    <td></td>
     				    <?php 
     				    for ($i=1; $i <= $col; $i++) { 
     				    	echo "<th>Nivel $i</th>";
     				    }
     				    ?>
     				   
     					</tr>
   					</thead>
   					<tbody>

   				    	<?php 
   				    	foreach ($table as $key => $value) {
   				    		echo "<tr>";
   				    		   				    		
   				    		echo "<th>$key</th>";
   				    		foreach ($value as $level => $score) {
   				    			echo "<th>$level</th>";
   				    		}

   				    		echo "</tr>";
   				    	}

   				    	?>
   				    	

   				    </tbody>
   			</table>

					
	</div>
				</div>
 </div>
		</div>
		</div> 
	</div>
</section><!-- FIN BUSCADOR -->
<section >
	<div class="container">
		<div class="row">
			<h2></h2>
			<div class="panel panel-default">
				<div class="panel-body" >
					<h2 class="title">Social</h2>
					</div>
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