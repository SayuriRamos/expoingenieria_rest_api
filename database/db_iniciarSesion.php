<?php
	// Include config.php file
	include_once '../config.php';

	// Create a class proyecto
	class db_juez extends Config {
	  // Fetch all or a single user from database
	  public function fetch($id = 0) {
	    $sql = 'SELECT j.nombre, j.correo, j.usuario, j.contrasena, j.invitadoPor_nombre, tu.nombre as tipo_usuario 
        FROM juez as j 
        INNER JOIN tipo_usuario tu ON j.tipoUsuario_id = tu.tipoUsuario_id ';
	    if ($id > 0) {
	      $sql .= ' WHERE juez_id = :id';
	      $stmt = $this->conn->prepare($sql);
	      $stmt->execute(['id' => $id]);
	    } else {
	      $stmt = $this->conn->prepare($sql);
	      $stmt->execute();
	    }
	    $rows = $stmt->fetchAll();
	    return $rows;
	  }

	  // Insert an user in the database
	  public function insert($nombre, $correo, $usuario, $contrasena, $invitadoPor_nombre, $tipoUsuario_id) {
          //INSERT INTO `juez` (`juez_id`, `nombre`, `correo`, `usuario`, `contrasena`, `invitadoPor_nombre`, `tipoUsuario_id`) VALUES (NULL, 'roberto', 'roberto@correo.mx', 'roberto', 'roberto', 'maestro', '1'); 
	
		$sql = 'INSERT INTO juez (nombre, correo, usuario, contrasena, invitadoPor_nombre, tipoUsuario_id) 
					VALUES (:nombre, :correo, :usuario, :contrasena, :tipoUsuario_id)';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['nombre' => $nombre, 'correo' => $correo, 'usuario' => $usuario, 'contrasena' => $contrasena, 'tipoUsuario_id' => $tipoUsuario_id]);
		return true;
		
	  }
	}

?>