<?php
	// Include CORS headers
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	header('content-type: application/json; charset=utf-8');

	// Include action.php file
	include_once '../database/db.juez.php';
	// Create object of juezs class
	$juez = new db_juez();

	// create a api variable to get HTTP method dynamically
	$api = $_SERVER['REQUEST_METHOD'];

	// get id from url
	$id = (!empty($_GET) && intval($_GET['id']) > 0) ? intval($_GET['id']) : 0;

	// Get all or a single juez from database
	if ($api == 'GET') {
	  if ($id != 0) {
	    $data = $juez->fetch($id);
	  } else {
	    $data = $juez->fetch();
	  }
	  echo json_encode($data);
	}

	// Add a new juez into database
	if ($api == 'POST') {
	  $nombre = $juez->test_input($_POST['nombre']);
	  $correo = $juez->test_input($_POST['correo']);
      $usuario = $juez->test_input($_POST['usuario']);
	  $contrasena = $juez->test_input($_POST['contrasena']);
      $invitadoPor_nombre = $juez->test_input($_POST['invitadoPor_nombre']);
	  $tipoUsuario_id = $juez->test_input($_POST['tipoUsuario_id']);


	  if ($juez->insert($nombre, $correo, $usuario, $contrasena, $invitadoPor_nombre, $tipoUsuario_id)) {
	    echo $juez->message('juez added successfully!',false);
	  } else {
	    echo $juez->message('Failed to add an juez!',true);
	  }
	}

	// Update an juez in database
	if ($api == 'PUT') {
	  parse_str(file_get_contents('php://input'), $post_input);
      $nombre = $juez->test_input($post_input['nombre']);
	  $correo = $juez->test_input($post_input['correo']);
      $usuario = $juez->test_input($post_input['usuario']);
	  $contrasena = $juez->test_input($post_input['contrasena']);
      $invitadoPor_nombre = $juez->test_input($post_input['invitadoPor_nombre']);
	  $tipoUsuario_id = $juez->test_input($post_input['tipoUsuario_id']);

	  if ($id != null) {
	    if ($juez->update($nombre, $correo, $usuario, $contrasena, $invitadoPor_nombre, $tipoUsuario_id, $id)) {
	      echo $juez->message('juez updated successfully!',false);
	    } else {
	      echo $juez->message('Failed to update an juez!',true);
	    }
	  } else {
	    echo $juez->message('juez not found!',true);
	  }
	}

	// Delete an juez from database
	if ($api == 'DELETE') {
	  if ($id != null) {
	    if ($juez->delete($id)) {
	      echo $juez->message('juez deleted successfully!', false);
	    } else {
	      echo $juez->message('Failed to delete an juez!', true);
	    }
	  } else {
	    echo $juez->message('juez not found!', true);
	  }
	}

?>