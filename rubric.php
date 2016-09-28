<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Displays information about all the assignment modules in the requested course
 *
 * @package   mod_assign
 * @copyright 2012 NetSpot {@link http://www.netspot.com.au}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once (dirname ( dirname ( dirname ( __FILE__ ) ) ) . '/config.php');


// Print the header.
$strplural = get_string("modulenameplural", "assign");
$PAGE->navbar->add($strplural);
$PAGE->set_title($strplural);




$PAGE->set_pagelayout('embedded');
require_login();
$PAGE->set_context(context_system::instance());
$url = new moodle_url($CFG->wwwroot.'/local/ciae/editRubric.php');
$PAGE->set_url($url);




// Get the assign to render the page.
echo $assign->view('viewcourseindex');
