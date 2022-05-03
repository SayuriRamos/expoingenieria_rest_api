<?php

//todavia no esta terminado
	// Include CORS headers
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	header('content-type: application/json; charset=utf-8');

	// Include action.php file
	include_once '../database/db.iniciarSesion.php';
	// Create object of juezs class
	$juez = new db_iniciarSesion();

	// create a api variable to get HTTP method dynamically
	$api = $_SERVER['REQUEST_METHOD'];

	// get id from url
	$id = (!empty($_GET) && intval($_GET['id']) > 0) ? intval($_GET['id']) : 0;

	// Add a new juez into database
	if ($api == 'POST') {
      $usuario = $juez->test_input($_POST['usuario']);
	  $contrasena = $juez->test_input($_POST['contrasena']);

      if ($juez->fetc) {
        $data[0]['matricula']
      }

	  if ($juez->insert($nombre, $usuario, $contrasena)) {
	    echo $juez->message('juez added successfully!',false);
	  } else {
	    echo $juez->message('Failed to add an juez!',true);
	  }
	}

?>