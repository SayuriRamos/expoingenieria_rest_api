<?php
	// Include config.php file
	include_once '../config.php';

	// Create a class proyecto
	class db_proyecto extends Config {
	  // Fetch all or a single user from database
	  public function fetch($id = 0) {
	    $sql = 'SELECT p.proyecto_id, p.nombre_equipo, p.nombre_proyecto, p.descripcion, p.url_sala, p.url_video, a.nombre as asesor, c.nombre as categoria, l.nombre as lineaInvestigacin, t.nombre as tipoProyecto, n.descripcion as clasificacionInovacion, asi.nombre as asignatura from proyecto p 
		inner join asesor a on a.asesor_id = p.asesor_id
		inner join categoria c on c.categoria_id = p.categoria_id
		inner join linea_investigacion l on l.lineaInvestigacion_id = p.lineaInvestigacion_id
		inner join  tipo_proyecto t on t.tipoProyecto_id = p.tipoProyecto_id
		inner join clasificacion_innovacion n on n.nivel_id = p.nivel_id
		inner join asignatura asi on asi.asignatura_id = p.asignatura_id';
	    if ($id > 0) {
	      $sql .= ' WHERE proyecto_id = :id';
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
	  public function insert($nombre_equipo, $nombre_proyecto, $descripcion, $url_sala, $url_video, $asesor_id, $categoria_id, $lineaInvestigacion_id, $tipoProyecto_id, $nivel_id, $asignatura_id) {
	
		$sql = 'INSERT INTO proyecto (nombre_equipo, nombre_proyecto, descripcion, url_sala, url_video, asesor_id, categoria_id, lineaInvestigacion_id, tipoProyecto_id, nivel_id, asignatura_id) 
					VALUES (:nombre_equipo, :nombre_proyecto, :descripcion, :url_sala, :url_video, :asesor_id, :categoria_id, :lineaInvestigacion_id, :tipoProyecto_id, :nivel_id, :asignatura_id)';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['nombre_equipo' => $nombre_equipo, 'nombre_proyecto' => $nombre_proyecto, 'descripcion' => $descripcion, 'url_sala' => $url_sala, 'url_video' => $url_video, 'asesor_id' => $asesor_id, 'categoria_id' => $categoria_id, 'lineaInvestigacion_id' => $lineaInvestigacion_id, 'tipoProyecto_id' => $tipoProyecto_id, 'nivel_id' => $nivel_id, 'asignatura_id' => $asignatura_id]);
		return true;
		
	  }

	  // Update an user in the database
	  public function update($id, $nombre_equipo, $nombre_proyecto, $descripcion, $url_sala, $url_video, $asesor_id, $categoria_id, $lineaInvestigacion_id, $tipoProyecto_id, $nivel_id, $asignatura_id) {
	    $sql = 'UPDATE proyecto SET nombre_equipo= :nombre_equipo, nombre_proyecto= :nombre_proyecto, descripcion= :descripcion, url_sala= :url_sala, url_video= :url_video, asesor_id = :asesor_id, categoria_id= :categoria_id, lineaInvestigacion_id= :lineaInvestigacion_id, tipoProyecto_id= :tipoProyecto_id, nivel_id= :nivel_id, asignatura_id= :asignatura_id WHERE proyecto_id = :id';
		
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['id' => $id,'nombre_equipo' => $nombre_equipo, 'nombre_proyecto' => $nombre_proyecto, 'descripcion' => $descripcion, 'url_sala' => $url_sala, 'url_video' => $url_video, 'asesor_id' => $asesor_id, 'categoria_id' => $categoria_id, 'lineaInvestigacion_id' => $lineaInvestigacion_id, 'tipoProyecto_id' => $tipoProyecto_id, 'nivel_id' => $nivel_id, 'asignatura_id' => $asignatura_id]);
	    return true;
	  }

	  // Delete an user from database
	  public function delete($id) {
	    $sql = 'DELETE FROM proyecto WHERE proyecto_id = :id';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['id' => $id]);
	    return true;
	  }
	}

?>