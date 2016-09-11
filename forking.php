<?php
require_once (dirname ( dirname ( dirname ( __FILE__ ) ) ) . '/config.php');
GLOBAL $USER;

	$activityid = required_param('id', PARAM_INT);
	$record = new stdClass();
	$record->userid 			= $USER->id;
	$record->activityid         = $activityid;
	$record->timecreated 		= time();
	$record->edited    			= 0;

if($data =$DB->get_record('emarking_activity_draft',array('userid'=>$USER->id,'activityid'=>$activityid))){
	
	$forkUrl = new moodle_url($CFG->wwwroot.'/local/ciae/fork.php', array('id' => $data->id));
	redirect($forkUrl, 0);
}
else{
	$insert = $DB->insert_record('emarking_activity_draft', $record);
	$forkUrl = new moodle_url($CFG->wwwroot.'/local/ciae/fork.php', array('id' => $insert));
	redirect($forkUrl, 0);
}