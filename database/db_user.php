<?php
	// Include config.php file
	include_once '../config.php';

	// Create a class integrante
	class db_user extends Config {
	  // Fetch all or a single user from database
	  public function fetch($id = 0) {
	    $sql = 'SELECT * FROM integrante';
	    if ($id > 0) {
	      $sql .= ' WHERE id_integrante = :id';
		  $stmt = $this->conn->prepare($sql);
		  $stmt->execute(['id' => $id]);
	    }
		else {
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
		}
	   
	    $rows = $stmt->fetchAll();
	    return $rows;
	  }

	  // Insert an user in the database
	  public function insert($matricula, $nombre) {
	    $sql = 'INSERT INTO integrante (matricula, nombre) VALUES (:matricula, :nombre)';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['matricula' => $matricula, 'nombre' => $nombre]);
	    return true;
	  }

	  // Update an user in the database
	  public function update($matricula, $nombre, $id_integrante) {
	    $sql = 'UPDATE integrante SET matricula = :matricula, nombre = :nombre WHERE id_integrante = :id_integrante';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['matricula' => $matricula, 'nombre' => $nombre, 'id_integrante' => $id_integrante]);
	    return true;
	  }

	  // Delete an user from database
	  public function delete($id) {
	    $sql = 'DELETE FROM integrante WHERE id_integrante = :id';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['id' => $id]);
	    return true;
	  }
	}

?>