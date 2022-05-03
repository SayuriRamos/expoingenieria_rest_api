<?php
	// Include CORS headers
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	header('content-type: application/json; charset=utf-8');

	// Include action.php file
	include_once '../database/bd_rubrica_c1_innovacionProcesoProducto.php';
	// Create object of rubricas class
	$rubrica = new db_c1ProcesoProducto();

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
        $descripcion_presentacionAudiovisual = $json['rubrica_proyectoAcademico']['descripcion_presentacionAudiovisual'];
        $descripcion_calidadNarrativaDistracciones = $json['rubrica_proyectoAcademico']['descripcion_calidadNarrativaDistracciones'];
        $descripcion_calidadVideo = $json['rubrica_proyectoAcademico']['descripcion_calidadVideo'];
        $descripcion_claridadfluidez = $json['rubrica_proyectoAcademico']['descripcion_calidadfluidez'];
        $descripcion_tiempoExposicion = $json['rubrica_proyectoAcademico']['descripcion_tiempoExposicion'];
        $descripcion_participacion = $json['rubrica_proyectoAcademico']['descripcion_participacion'];
        $descripcion_originalidad = $json['rubrica_proyectoAcademico']['descripcion_originalidad'];
        $descripcion_funcionalidad = $json['rubrica_proyectoAcademico']['descripcion_funcionalidad'];
        $descripcion_relacionFisicoTeorica = $json['rubrica_proyectoAcademico']['descripcion_relacionFisicoTeorica'];        
        
        //Info que manda el juez
        $calificacion_contextoGeneral = $rubrica->test_input($_POST['calificacion_contextoGeneral']);
        $calificacion_explicacionConcepto = $rubrica->test_input($_POST['calificacion_explicacionConcepto']);
        $calificacion_presentacionAudiovisual  = $rubrica->test_input($_POST['calificacion_presentacionAudiovisual']);
        $calificacion_calidadNarrativaDistracciones  = $rubrica->test_input($_POST['calificacion_calidadNarrativaDistracciones']);
        $calificacion_calidadVideo  = $rubrica->test_input($_POST['calificacion_calidadVideo']);
        $calificacion_claridadfluidez = $rubrica->test_input($_POST['calificacion_claridadFluidez']);
        $calificacion_participacion = $rubrica->test_input($_POST['calificacion_participacion']);
        $calificacion_tiempoExposicion = $rubrica->test_input($_POST['calificacion_tiempoExposicion']);
        $calificacion_originalidad = $rubrica->test_input($_POST['calificacion_originalidad']);
        $calificacion_funcionalidad = $rubrica->test_input($_POST['calificacion_funcionalidad']);
        $calificacion_relacionFisicoTeorica = $rubrica->test_input($_POST['calificacion_relacionFisicoTeorica']);        

	  if ($rubrica->insert(
      $proyecto_id, $juez_id, 
      $calificacion,
          $observacion,
          $descripcion_contextoGeneral,
          $descripcion_explicacionConcepto,
          $descripcion_presentacionAudiovisual,
      $descripcion_calidadNarrativaDistracciones,
      $descripcion_calidadVideo,
          $descripcion_claridadfluidez,
          $descripcion_participacion,
      $descripcion_tiempoExposicion,
          $descripcion_funcionalidad,
          $descripcion_relacionFisicoTeorica,
      $descripcion_originalidad
        )) {
	    echo $rubrica->message('calificacion added successfully!',false);
	  } else {
	    echo $rubrica->message('Failed to add an calificacion!',true);
	  }
	}


?>