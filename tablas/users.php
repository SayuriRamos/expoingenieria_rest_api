<?php
	// Include CORS headers
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	header('content-type: application/json; charset=utf-8');

	// Include action.php file
	include_once '../database/db_user.php';
	// Create object of Users class
	$user = new db_user();

	// create a api variable to get HTTP method dynamically
	$api = $_SERVER['REQUEST_METHOD'];

	// get id from url
	$id = (!empty($_GET) && intval($_GET['id']) > 0) ? intval($_GET['id']) : 0;

	// Get all or a single user from database
	if ($api == 'GET') {
	  if ($id != 0) {
	    $data = $user->fetch($id);
	  } else {
	    $data = $user->fetch();
	  }
	  echo json_encode($data);
	}

	// Add a new user into database
	if ($api == 'POST') {
	  $matricula = $user->test_input($_POST['matricula']);
	  $nombre = $user->test_input($_POST['nombre']);

	  if ($user->insert($matricula, $nombre)) {
	    echo $user->message('User added successfully!',false);
	  } else {
	    echo $user->message('Failed to add an user!',true);
	  }
	}

	// Update an user in database
	if ($api == 'PUT') {
	  parse_str(file_get_contents('php://input'), $post_input);

	  $matricula = $user->test_input($post_input['matricula']);
	  $nombre = $user->test_input($post_input['nombre']);

	  if ($id != null) {
	    if ($user->update($matricula, $nombre, $id)) {
	      echo $user->message('User updated successfully!',false);
	    } else {
	      echo $user->message('Failed to update an user!',true);
	    }
	  } else {
	    echo $user->message('User not found!',true);
	  }
	}

	// Delete an user from database
	if ($api == 'DELETE') {
	  if ($id != null) {
	    if ($user->delete($id)) {
	      echo $user->message('User deleted successfully!', false);
	    } else {
	      echo $user->message('Failed to delete an user!', true);
	    }
	  } else {
	    echo $user->message('User not found!', true);
	  }
	}

?>