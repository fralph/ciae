<?php
require_once (dirname ( dirname ( dirname ( __FILE__ ) ) ) . '/config.php');
//include simplehtml_form.php
require_once('forms/create_activity.php');
 //Código para setear contexto, url, layout
global $PAGE,$USER, $CFG, $OUTPUT, $DB;

$PAGE->set_pagelayout('base');

	echo $OUTPUT->header();

	

//Instantiate simplehtml_form 
$mform = new local_ciae_create_activity();
 
//Form processing and displaying is done here
if ($mform->is_cancelled()) {
    //Handle form cancel operation, if cancel button is present on form
} else if ($fromform = $mform->get_data()) {

$instructions=$fromform->instructions['text'];
$suggestion=$fromform->didacticSuggestions['text'];

$record = new stdClass();
$record->type         			= 1;
$record->rubric_id 				= $fromform->rubric;
$record->oa         			= $fromform->oa;
$record->title 					= $fromform->titulo;
$record->comunicative_purpose   = $fromform->pc;
$record->genre 					= $fromform->genero;
$record->audience         		= $fromform->audience;
$record->estimated_time 		= $fromform->tiempoEstimado;
$record->video_url         		= $fromform->videoUrl;
$record->instructions 			= $fromform->instructions['text'];
$record->description         	= $fromform->description;
$record->userid 				= $USER->id;
$record->didactic_suggestions 	= $fromform->didacticSuggestions['text'];
$record->didactic_instructions  = $fromform->didacticInstructions['text'];
$record->language_resources 	= $fromform->LanguageInstructions['text'];

$insert = $DB->insert_record('emarking_activities', $record);

  //In this case you process validated data. $mform->get_data() returns data posted in form.
} else {
  // this branch is executed if the form is submitted but the data doesn't validate and the form should be redisplayed
  // or on the first display of the form.
 
  //Set default data (if any)

  //displays the form
  $mform->display();
}


//Código para setear contexto, url, layout
echo $OUTPUT->footer();

?>