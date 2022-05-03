<?php
	// Include CORS headers
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	header('content-type: application/json; charset=utf-8');

	// Include action.php file
	include_once '../database/bd_rubrica_proyectoacademico.php';
	// Create object of rubricas class
	$rubrica = new db_proyectoAcademico();

	// create a api variable to get HTTP method dynamically
	$api = $_SERVER['REQUEST_METHOD'];

  if ($api == 'GET') {
	  $data = $rubrica->fetch();
	  echo json_encode($data);
	}

	// Add a new rubrica into database
	if ($api == 'POST') {
        
        //info de Tipo_Rubrica (manda el juez tambien)
        $proyecto_id = $rubrica->test_input($_POST['proyecto_id']);
        $juez_id = $rubrica->test_input($_POST['juez_id']);
        $calificacion = $rubrica->test_input($_POST['calificacion']);
        $observacion = $rubrica->test_input($_POST['observacion']);


        //info de json para descripcion de calificacion
        $str = file_get_contents('https://expoingenieria.com/rest_api_expo/descripcion_proyectoAcademico.json');
        $json = json_decode($str, true); // decode the JSON into an associative array
        $descripcion_contextoGeneral = $json['rubrica_proyectoAcademico']['descripcion_contextoGeneral'];
        $descripcion_explicacionConcepto = $json['rubrica_proyectoAcademico']['descripcion_explicacionConcepto'];
        $descripcion_presentacionFisica = $json['rubrica_proyectoAcademico']['descripcion_presentacionFisica'];
        $descripcion_presentacionAudiovisual = $json['rubrica_proyectoAcademico']['descripcion_presentacionAudiovisual'];
        $descripcion_ClaridadFluidez = $json['rubrica_proyectoAcademico']['descripcion_ClaridadFluidez'];
        $descripcion_tiempoExposicion = $json['rubrica_proyectoAcademico']['descripcion_tiempoExposicion'];
        $descripcion_participacion = $json['rubrica_proyectoAcademico']['descripcion_participacion'];
        $descripcion_desarrolloSistPropios = $json['rubrica_proyectoAcademico']['descripcion_desarrolloSistPropios'];
        $descripcion_originalidad = $json['rubrica_proyectoAcademico']['descripcion_originalidad'];
        $descripcion_funcionalidad = $json['rubrica_proyectoAcademico']['descripcion_funcionalidad'];
        $descripcion_relacionFisicoTeorica = $json['rubrica_proyectoAcademico']['descripcion_relacionFisicoTeorica'];
        $descripcion_tiempoRespuesta = $json['rubrica_proyectoAcademico']['descripcion_tiempoRespuesta'];
        $descripcion_conceptoComunicacionVisualMensaje = $json['rubrica_proyectoAcademico']['descripcion_conceptoComunicacionVisualMensaje'];
        $descripcion_diseno = $json['rubrica_proyectoAcademico']['descripcion_diseno'];
        $descripcion_organizacionElementos = $json['rubrica_proyectoAcademico']['descripcion_organizacionElementos'];
        $descripcion_disenoInterfaz = $json['rubrica_proyectoAcademico']['descripcion_disenoInterfaz'];
        
        
        //Info que manda el juez
        $calificacion_contextoGeneral = $rubrica->test_input($_POST['calificacion_contextoGeneral']);
        $calificacion_explicacionConcepto = $rubrica->test_input($_POST['calificacion_explicacionConcepto']);
        $calificacion_presentacionFisica = $rubrica->test_input($_POST['calificacion_presentacionFisica']);
        $calificacion_presentacionAudiovisual  = $rubrica->test_input($_POST['calificacion_presentacionAudiovisual']);
        $calificacion_ClaridadFluidez = $rubrica->test_input($_POST['calificacion_ClaridadFluidez']);
        $calificacion_participacion = $rubrica->test_input($_POST['calificacion_participacion']);
        $calificacion_tiempoExposicion = $rubrica->test_input($_POST['calificacion_tiempoExposicion']);
        $calificacion_desarrolloSistPropios = $rubrica->test_input($_POST['calificacion_desarrolloSistPropios']);
        $calificacion_originalidad = $rubrica->test_input($_POST['calificacion_originalidad']);
        $calificacion_funcionalidad = $rubrica->test_input($_POST['calificacion_funcionalidad']);
        $calificacion_relacionFisicoTeorica = $rubrica->test_input($_POST['calificacion_relacionFisicoTeorica']);
        $calificacion_tiempoRespuesta = $rubrica->test_input($_POST['calificacion_tiempoRespuesta']);
        $calificacion_conceptoComunicacionVisualMensaje = $rubrica->test_input($_POST['calificacion_conceptoComunicacionVisualMensaje']);
        $calificacion_diseno = $rubrica->test_input($_POST['calificacion_diseno']);
        $calificacion_organizacionElementos = $rubrica->test_input($_POST['calificacion_organizacionElementos']);
        $calificacion_disenoInterfaz = $rubrica->test_input($_POST['calificacion_disenoInterfaz']);
        

	  if ($rubrica->insert(
        $proyecto_id, $juez_id, 
        $calificacion,
        $observacion,
        $descripcion_contextoGeneral,
        $descripcion_explicacionConcepto,
        $descripcion_presentacionFisica,
        $descripcion_presentacionAudiovisual,
        $descripcion_ClaridadFluidez,
        $descripcion_participacion,
        $descripcion_desarrolloSistPropios,
        $descripcion_originalidad,
        $descripcion_funcionalidad,
        $descripcion_relacionFisicoTeorica,
        $descripcion_tiempoRespuesta,	
        $descripcion_tiempoExposicion,
        $descripcion_conceptoComunicacionVisualMensaje,
        $descripcion_diseno,
        $descripcion_organizacionElementos,
        $descripcion_disenoInterfaz,
        $calificacion_contextoGeneral,
        $calificacion_explicacionConcepto,
        $calificacion_presentacionFisica,
        $calificacion_presentacionAudiovisual,
        $calificacion_ClaridadFluidez,
        $calificacion_participacion,
        $calificacion_tiempoExposicion,
        $calificacion_desarrolloSistPropios,
        $calificacion_originalidad,
        $calificacion_funcionalidad,
        $calificacion_relacionFisicoTeorica,
        $calificacion_tiempoRespuesta,
        $calificacion_conceptoComunicacionVisualMensaje,
        $calificacion_diseno,
        $calificacion_organizacionElementos,
        $calificacion_disenoInterfaz
        )) {
	    echo $rubrica->message('calificacion added successfully!',false);
	  } else {
	    echo $rubrica->message('Failed to add an calificacion!',true);
	  }
	}


?>