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
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <http://www.gnu.org/licenses/>.

/**
 * This form is used to upload a zip file containing digitized answers
 *
 * @package local
 * @subpackage ciae
 * @copyright 2016 Francisco Ralph <francisco.garcia@ciae.uchile.cl>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once ($CFG->libdir . '/formslib.php');
require_once ($CFG->dirroot . '/course/lib.php');


class local_ciae_rubric_form extends moodleform {

    public function definition() {
        global $CFG, $OUTPUT, $COURSE, $DB;

        $mform = $this->_form; // Don't forget the underscore! 
        // Paso 1 Información básica
        $mform->addElement('header', 'db', 'Información Rúbrica', null);
        //Título
        $mform->addElement('text', 'title','Título'); 
        $mform->setType('title', PARAM_TEXT);
        $mform->addRule('title', get_string('required'), 'required');
        //descripción
        $mform->addElement('static', '', '','Pequeña descrición sobre la actividad a realizar, max 500 caracteres.');
        $mform->addElement('textarea', 'description', "Descripción", 'wrap="virtual" rows="10" cols="50" maxlength="400"'); 
        $mform->setType('description', PARAM_TEXT);
 
        $mform->addElement('static', '', '','Los objetivos que entrega el ministerio de educación.');

        
        $this->add_action_buttons(true,'enviar');

            

        

    }
    //Custom validation should be added here
    function validation($data, $files)
    {

      return true;
    }
}