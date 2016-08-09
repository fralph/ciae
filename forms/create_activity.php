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


class local_ciae_create_activity extends moodleform {

    public function definition() {
        global $CFG, $OUTPUT, $COURSE, $DB;
        
       require_once ('generos.php');
       array_unshift($generos, "Seleccione un género");
       $result = $DB->get_records('grading_definitions');
       $rubrics[0]= 'Seleccione una rúbrica';
        foreach ($result as $data) {
            $rubrics[$data->id]=$data->name;
        }
        //pc= Proposito comunicativo, obtenidos de la agencia de calidad
        $pc=array('Seleccione un propósito comunicativo','Informar','Narrar','Opinar');

        $mform = $this->_form; // Don't forget the underscore! 
        // Paso 1 Información básica
        $mform->addElement('header', 'db', 'Información Básica', null);
        //Título
        $mform->addElement('text', 'titulo','Título'); 
        $mform->setType('titulo', PARAM_TEXT);
        $mform->addRule('titulo', get_string('required'), 'required');
        //descripción
        $mform->addElement('static', '', '','Pequeña descrición sobre la actividad a realizar, max 500 caracteres.');
        $mform->addElement('textarea', 'descripcion', "Descripción", 'wrap="virtual" rows="10" cols="50" maxlength="400"'); 
        $mform->setType('descripcion', PARAM_TEXT);
 
        $mform->addElement('static', '', '','Los objetivos que entrega el ministerio de educación.');
        //Curso
        $courseArray=array('0'=>'Seleccione un curso','1'=>'1° básico','2'=>'2° básico','3'=>'3° básico',
            '4'=>'4° básico','5'=>'5° básico','6'=>'6° básico',);
        $selectCourse =& $mform->createElement('select', 'course', 'curso',$courseArray);
       //OA
        $oaArray=array('13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21',
                        '22'=>'22');
        $selectOA =& $mform->createElement('select', 'oa', 'Objetivo de Aprendizaje',$oaArray);
        $selectOA->setMultiple(true);
        //grupo de select Curso-OA
        $oaArray=array($selectCourse,$selectOA);
        $mform->addGroup($oaArray,'codigoOA','Objetivo de aprendizaje');
        $mform->addRule('codigoOA', get_string('required'), 'required');
        $mform->addHelpButton('codigoOA', 'codigoOA','ciae');

        // Propósito comunicativo
        $mform->addElement('select', 'pc', 'Propósito Comunicativo', $pc);
        $mform->addRule('pc', get_string('required'), 'required'); 
        $mform->setType('pc', PARAM_TEXT);
        $mform->addHelpButton('pc', 'pc','ciae');
        // Género
        $mform->addElement('select', 'genero', 'Género', $generos);
        $mform->addRule('genero', get_string('required'), 'required'); 
        $mform->setType('genero', PARAM_TEXT);
        $mform->addHelpButton('genero', 'genero','ciae');
        // Audiencia
        $mform->addElement('text', 'audiencia','Audiencia'); 
        $mform->setType('audiencia', PARAM_TEXT);
        $mform->addHelpButton('audiencia', 'audiencia','ciae');
        // Tiempo estimado
        $tiempoEstimado=array('45'=>'45 minutos','90'=>'90 minutos','135'=>'135 minutos','180'=>'180 minutos');
        $mform->addElement('select', 'tiempoEstimado', 'Tiempo Estimado', $tiempoEstimado);
        $mform->addRule('tiempoEstimado', get_string('required'), 'required');
        $mform->setType('tiempoEstimado', PARAM_TEXT);      

        //Paso 2 Instrucciones
        $mform->addElement('header', 'IA', 'Instrucciones para el Alumno', null);
        $mform->addElement('static', '', '','Cree las instrucciones que se entregarán a los alumnos.');
        $mform->addElement('editor', 'instructions', 'Instrucciones');
        $mform->setType('ejemplo', PARAM_RAW);

        //Paso 3 Didáctica
        $mform->addElement('header', 'DI', 'Didáctica', null);
        $mform->addElement('editor', 'didacticSuggestions', 'Didáctica');
        $mform->setType('ejemplo', PARAM_RAW);
        $mform->addElement('editor', 'didacticInstructions', 'Sugerencias');
        $mform->setType('didacticInstructions', PARAM_RAW);
        $mform->setAdvanced('didacticInstructions');
        $mform->addElement('editor', 'LanguageInstructions', 'Recursos del Lenguaje');
        $mform->setType('LanguageInstructions', PARAM_RAW);
        $mform->setAdvanced('LanguageInstructions');

        //Paso 4 Rúbrica
        $mform->addElement('header', 'RUB', 'Rúbrica', null);
        $mform->addElement('select', 'rubric', 'Rúbrica', $rubrics);
        
        $this->add_action_buttons(true,'enviar');


    }
    //Custom validation should be added here
    function validation($data, $files) {
        
        if ($data[genero]==0) {
            $errors ['genero'] = 'Debe seleccionar un género';
        }
        if ($data[rubric]==0) {
            $errors ['rubric'] = 'Debe seleccionar una rúbrica';
        }
        if ($data[pc]==0) {
            $errors ['pc'] = 'Debe seleccionar un propósito comunicativo';
        }
    return $errors;
    }
}