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
       $result = $DB->get_records_sql('
        SELECT gd.id,
               gd.name,
               gd.description 
        FROM {grading_definitions} as gd, 
             {grading_areas} as ga 
        WHERE ga.id=gd.areaid AND
              gd.method=? AND 
              ga.contextid=? AND  
              ga.component=?', array('rubric',1,'core_grading'));
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
        $mform->addElement('textarea', 'descripcion', "Descripción", 'wrap="virtual" rows="10" cols="50"'); 
        $mform->setType('descripcion', PARAM_TEXT);
        // OA
        $mform->addElement('text', 'oa','Objetivo de aprendizaje'); 
        $mform->addRule('oa', get_string('required'), 'required'); 
        $mform->setType('oa', PARAM_TEXT);


       
        //Curso
        $courseArray=array('Seleccione un curso','1° básico','2° básico','3° básico',
            '4° básico','5° básico','6° básico',);
        $selectCourse =& $mform->createElement('select', 'course', 'curso',$courseArray);
       //OA
        $oaArray=array('13','14','15','16','17','18','19','20','21',
                        '22');
        $selectOA =& $mform->createElement('select', 'oa', 'Objetivo de Aprendizaje',$oaArray);
        $selectOA->setMultiple(true);
        //grupo de select Curso-OA
        $oaArray=array($selectCourse,$selectOA);
        $mform->addGroup($oaArray,'algo','Objetivo de aprendizaje');
        $mform->addRule('algo', get_string('required'), 'required'); 



        // Propósito comunicativo
        $mform->addElement('select', 'pc', 'Propósito Comunicativo', $pc);
        $mform->addRule('pc', get_string('required'), 'required'); 
        $mform->setType('pc', PARAM_TEXT);
        // Género
        $mform->addElement('select', 'genero', 'Género', $generos);
        $mform->addRule('genero', get_string('required'), 'required'); 
        $mform->setType('genero', PARAM_TEXT);
        // Audiencia
        $mform->addElement('text', 'audiencia','Audiencia'); 
        $mform->setType('audiencia', PARAM_TEXT);
        // Tiempo estimado
        $mform->addElement('text', 'tiempoEstimado','Tiempo Estimado'); 
        $mform->setType('tiempoEstimado', PARAM_TEXT);        

        //Paso 2 Instrucciones
        $mform->addElement('header', 'IA', 'Instrucciones para el Alumno', null);
        $mform->addElement('editor', 'instructions', 'Instrucciones');
        $mform->setType('ejemplo', PARAM_RAW);

        //Paso 3 Didáctica
        $mform->addElement('header', 'DI', 'Didáctica', null);
        $mform->addElement('editor', 'didacticSuggestions', 'Sugerencias Didacticas');
        $mform->setType('ejemplo', PARAM_RAW);
        $mform->addElement('editor', 'didacticInstructions', 'Instrucciones Didacticas');
        $mform->setType('ejemplo', PARAM_RAW);
        $mform->addElement('editor', 'LanguageInstructions', 'Recursos del Lenguaje');
        $mform->setType('ejemplo', PARAM_RAW);

        //Paso 4 Rúbrica
        $mform->addElement('header', 'RUB', 'Rúbrica', null);
        $mform->addElement('select', 'rubric', 'Rúbrica', $rubrics);
        







      
        
        
        

        
      //  $mform->addElement('filepicker', 'actirivy', 'actividad', null,
        //           array('maxbytes' => $maxbytes, 'accepted_types' => array('doc','docx','pdf')));

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