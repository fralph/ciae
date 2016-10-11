<?php

$url = new moodle_url($CFG->wwwroot.'/local/ciae/editRubric.php');
require_once('forms/rubric.php');
require_once($CFG->dirroot.'/grade/grading/form/rubric/lib.php');
require_once($CFG->dirroot.'/grade/grading/lib.php');

$id = optional_param("id",0, PARAM_INT);

//si existe voy a buscar la rúbrica


//si no existe

echo $OUTPUT->header();

//Instantiate simplehtml_form
$mform = new local_ciae_rubric_form();

//Form processing and displaying is done here
if ($mform->is_cancelled()) {
    //Handle form cancel operation, if cancel button is present on form
} else if ($fromform = $mform->get_data()) {

}else{
    // this branch is executed if the form is submitted but the data doesn't validate and the form should be redisplayed
    // or on the first display of the form.

    //Set default data (if any)

    //displays the form
    $mform->display();
}

//Código para setear contexto, url, layout
echo $OUTPUT->footer();

?>