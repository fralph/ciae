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
			
			
			</div>	
			</div>
			</div>
			
		</div>
	</div>
</section>