<?php 
require_once (dirname ( dirname ( dirname ( __FILE__ ) ) ) . '/config.php');

/**
 * Function to create the table for rubrics
 * 
 * @param string $id
 *            
 * @return the table with the rubric's data
 */
function show_rubric($id) {
	global $DB;
$sql="SELECT grl.id,
			 grc.id as grcid,
			 grl.score,
			 grl.definition,
			 grc.description,
			 grc.sortorder,
			 gd.name
	  FROM mdl_gradingform_rubric_levels as grl,
	 	   mdl_gradingform_rubric_criteria as grc,
    	   mdl_grading_definitions as gd
	  WHERE gd.id='$id' AND grc.definitionid=gd.id AND grc.id=grl.criterionid
	  ORDER BY grcid, grl.id";
	
$rubric=$DB->get_records_sql($sql);
	
	
	foreach ($rubric as $data) {
	
		$tableData[$data->description][$data->definition]=$data->score;
	}
	
	$col=0;
	foreach ($tableData as $calc) {
	
		$actualcol=sizeof($calc);
		if($col < $actualcol){
			$col=$actualcol;
		}
	
	}
	$row=sizeof($table);
	$table ="";
	$table .='<table class="table table-bordered">';
	$table .='<thead>';
	$table .='<tr>';
	$table .='<td>';
	$table .='</td>';
	
	for ($i=1; $i <= $col; $i++) {
		$table .='<th>Nivel '.$i.'</th>';
	}
	
	     				   
	    $table .='</tr>';
	   	$table .='</thead>';
	   	$table .='<tbody>';
	
	 
	   	foreach ($tableData as $key => $value) {
	   		
	   		$table .='<tr>';   				    		
	   				    		$table .='<th>'.$key.'</th>';
	   				    		foreach ($value as $level => $score) {
	   				    			$table .='<th>'.$level.'</th>';
	   				    		}
	
	   				    		$table .='</tr>';
	   				    	}
	   				    	$table .='</tbody>';
	   				    	$table .='</table>';
	   				    		
	
 return $table;	
 
}

function show_result($data){
	GLOBAL $CFG;
	$activityUrl= new moodle_url($CFG->wwwroot.'/local/ciae/activity.php',array('id'=>$data->id));
	$show='<a href="'.$activityUrl.'">';
	$show.='<div id="resultados" class="col-md-12" style="text-align: left">';
	$show.='<div class="panel panel-default">';
	$show.='<div class="single-result-detail clearfix">';
	$show.='<div id="descripcion" class="panel-body">';
	$show.='<center><h3>'.$data->title.'</h3></center>';
	$show.='<div  class="col-md-4" style="text-align: left">';
	$show.='<p>Propósito Comunicativo: Informar</p>';
	$show.='<p>Género: '.$generos[$data->genre].$data->genre.'</p>';
	$show.='<p>Audiencia: '.$data->audience.'</p>';
	$show.='<p>Duración: 90 min.</p>';
	$show.='<p>Contiene:';
	$show.='<span class="glyphicon glyphicon-film" aria-hidden="false"></span>';
	$show.='<span class="glyphicon glyphicon-book" aria-hidden="false"></span>';
	$show.='<span class="glyphicon glyphicon-print" aria-hidden="false"></span>';
	$show.='</p>';
	$show.='</div>';
	$show.='<div  class="col-md-5">';
	$show.='<p>'.$data->description.'</p>';
	$show.='</div>';
	$show.='<div  class="col-md-3" style="text-align: left">';
	$show.='<img src="img/premio.png" class="premio" height="40px" width="40px">';
	$show.='<p>55 Visitas</p>';
	$show.='<p>3 Comentarios</p>';
	$show.='<p>20 votos</p>';
	$show.='<span class="glyphicon glyphicon-star" aria-hidden="true"></span>';
	$show.='<span class="glyphicon glyphicon-star" aria-hidden="true"></span>';
	$show.='<span class="glyphicon glyphicon-star" aria-hidden="true"></span>';
	$show.='<span class="glyphicon glyphicon-star" aria-hidden="true"></span>';
	$show.='<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>';
	$show.='<p></p><p></p>';
		
	$show.='</div>';
	$show.='</div>';
	$show.='</div>';
	
	$show.='</div>';
	$show.='</div>';
	$show.='</a>';
	return $show;
	
}