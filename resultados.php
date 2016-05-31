<?php
require_once (dirname ( dirname ( dirname ( __FILE__ ) ) ) . '/config.php');
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
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>Lorem Ipsum</title>
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
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

<link rel="stylesheet" href="auto-complete.css">
<script src="js/modernizr.js"></script>


<!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

</head>
<body>

	<!-- ====================================================
	header section -->
	<header class="top-header">
		<div class="container">
			<div class="row">
				<div class="col-xs-3 header-logo">

					<a href="index.html"><img src="img/logo.png" alt=""
						class="img-responsive logo"></a>
				</div>

				<div class="col-md-9">
					<nav class="navbar navbar-default">
						<div class="container-fluid nav-bar">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed "
									data-toggle="collapse"
									data-target="#bs-example-navbar-collapse-1">
									<span class="sr-only">Toggle navigation</span> <span
										class="icon-bar"></span> <span class="icon-bar"></span> <span
										class="icon-bar"></span>
								</button>
							</div>

							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse"
								id="bs-example-navbar-collapse-1">

								<ul class="nav navbar-nav navbar-right">
									<li><a class="menu active" href="#home">Inicio</a></li>
									<li><a class="menu" href="#buscar">Buscar</a></li>
									<li><a class="menu" href="#nosotros">Sobre nosotros</a></li>
									<li><a class="menu" href="#profesor">Profesores</a></li>
									<li><a class="menu" href="#corrector">¿Quieres ser corrector? </a></li>
					        <?php if(!$logged){?><li><a class="menu"
										href="http://ciae.edocere.com/login/index.php">Entrar</a></li><?php }?>
					        
					        
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
	<!-- end of header area -->


	<!-- buscar section -->
	<section class="about text-center" id="buscar">
		<div class="container">
			<div class="row">
				<h2></h2>
				<div class="col-md-2 col-sm-6"></div>
				<div class="col-md-10 col-sm-6">
					<form method="get" action="resultados.php" class="pure-form"
						style="border-top: 1px solid #eee; border-bottom: 1px solid #eee; background: #fafafa; padding: 20px 10px; text-align: center">
						<div class="single-about-detail clearfix">
							<div class="">
								<div class="form-group">

									<div class="col-xs-7">
										<input id="recursos" autofocus type="text" name="name"
											placeholder="Nombre" style="width: 100%; max-width: 600px">
									</div>
									<div class="col-xs-2">
										<button type="submit" class="btn btn-default">Buscar</button>

									</div>
								</div>
							</div>
						</div>
					</form>

				</div>
			</div>
			</div></section>
<section>
			<div class="container">
    <div class="row clearfix">
		<div class="col-md-12 column">
			<table class="table table-bordered table-hover" id="tab_logic">
				<thead>
					<tr >
						<th class="text-center">
							#
						</th>
						<th class="text-center">
							Name
						</th>
						<th class="text-center">
							Mail
						</th>
						<th class="text-center">
							Mobile
						</th>
					</tr>
				</thead>
				<tbody>
					<tr id='addr0'>
						<td>
						1
						</td>
						<td>
						<input type="text" name='name0'  placeholder='Name' class="form-control"/>
						</td>
						<td>
						<input type="text" name='mail0' placeholder='Mail' class="form-control"/>
						</td>
						<td>
						<input type="text" name='mobile0' placeholder='Mobile' class="form-control"/>
						</td>
					</tr>
                    <tr id='addr1'></tr>
				</tbody>
			</table>
		</div>
	</div>
	<a id="add_row" class="btn btn-default pull-left" onclick="myFunction()">Add Row</a><a id='delete_row' class="pull-right btn btn-default">Delete Row</a>
</div>
			
			
			
</section>
	<!-- end of buscar section -->

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


	<!-- script tags
	============================================================= -->
	<script src="js/jquery-2.1.1.js"></script>

	<script src="js/smoothscroll.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/custom.js"></script>
	<script src="js/auto-complete.js"></script>
	
	

<script>
function myFunction() {
    var table = document.getElementById("tab_logic");
    var row = table.insertRow(2);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    cell1.innerHTML = "NEW CELL1";
    cell2.innerHTML = "NEW CELL2";
}
</script>
</body>
</html>