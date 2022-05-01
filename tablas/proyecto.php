<?php
	// Include CORS headers
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	header('content-type: application/json');

	// Include action.php file
	include_once '../database/db_proyecto.php';
	// Create object of proyectos class
	$proyecto = new db_proyecto();

	// create a api variable to get HTTP method dynamically
	$api = $_SERVER['REQUEST_METHOD'];

	// get id from url
	//$id = intval($_GET['id'] ?? '');
	// Ajuste 25/04/22, sustituye a linea anterior
	$id = (!empty($_GET) && intval($_GET['id']) > 0) ? intval($_GET['id']) : 0;

	// Get all or a single proyecto from database
	if ($api == 'GET') {
	  if ($id != 0) {
	    $data = $proyecto->fetch($id);
	  } else {
	    $data = $proyecto->fetch();
	  }
	  echo json_encode($data);
	}

	// Add a new proyecto into database
	if ($api == 'POST') {
	  $nombre_equipo = $proyecto->test_input($_POST['nombre_equipo']);
	  $nombre_proyecto = $proyecto->test_input($_POST['nombre_proyecto']);
	  $descripcion = $proyecto->test_input($_POST['descripcion']);
	  $url_sala = $proyecto->test_input($_POST['url_sala']);
	  $url_video = $proyecto->test_input($_POST['url_video']);
	  $asesor_id = $proyecto->test_input($_POST['asesor_id']);
	  $categoria_id = $proyecto->test_input($_POST['categoria_id']);
	  $lineaInvestigacion_id = $proyecto->test_input($_POST['lineaInvestigacion_id']);
	  $tipoProyecto_id = $proyecto->test_input($_POST['tipoProyecto_id']);
	  $nivel_id = $proyecto->test_input($_POST['nivel_id']);
	  $asignatura_id = $proyecto->test_input($_POST['asignatura_id']);

	  if ($proyecto->insert($nombre_equipo, $nombre_proyecto, $descripcion, $url_sala, $url_video, $asesor_id, $categoria_id, $lineaInvestigacion_id, $tipoProyecto_id, $nivel_id, $asignatura_id)) {
	    echo $proyecto->message('proyecto added successfully!',false);
	  } else {
	    echo $proyecto->message('Failed to add an proyecto!',true);
	  }
	}

	// Update an proyecto in database
	if ($api == 'PUT') {
	  parse_str(file_get_contents('php://input'), $post_input);

	  $nombre_equipo = $proyecto->test_input($post_input['nombre_equipo']);
	  $nombre_proyecto = $proyecto->test_input($post_input['nombre_proyecto']);
	  $descripcion = $proyecto->test_input($post_input['descripcion']);
	  $url_sala = $proyecto->test_input($post_input['url_sala']);
	  $url_video = $proyecto->test_input($post_input['url_video']);
	  $asesor_id = $proyecto->test_input($post_input['asesor_id']);
	  $categoria_id = $proyecto->test_input($post_input['categoria_id']);
	  $lineaInvestigacion_id = $proyecto->test_input($post_input['lineaInvestigacion_id']);
	  $tipoProyecto_id = $proyecto->test_input($post_input['tipoProyecto_id']);
	  $nivel_id = $proyecto->test_input($post_input['nivel_id']);
	  $asignatura_id = $proyecto->test_input($post_input['asignatura_id']);

	  if ($id != null) {
	    if ($proyecto->update($id, $nombre_equipo, $nombre_proyecto, $descripcion, $url_sala, $url_video, $asesor_id, $categoria_id, $lineaInvestigacion_id, $tipoProyecto_id, $nivel_id, $asignatura_id)) {
	      echo $proyecto->message('proyecto updated successfully!',false);
	    } else {
	      echo $proyecto->message('Failed to update an proyecto!',true);
	    }
	  } else {
	    echo $proyecto->message('proyecto not found!',true);
	  }
	}

	// Delete an proyecto from database
	if ($api == 'DELETE') {
	  if ($id != null) {
	    if ($proyecto->delete($id)) {
	      echo $proyecto->message('proyecto deleted successfully!', false);
	    } else {
	      echo $proyecto->message('Failed to delete an proyecto!', true);
	    }
	  } else {
	    echo $proyecto->message('proyecto not found!', true);
	  }
	}

?>